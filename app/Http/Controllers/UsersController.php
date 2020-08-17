<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Micropost;
use Illuminate\Support\Facades\Storage; //画像を表示するためにStorageを使う

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザの投稿を取得
        $microposts = Micropost::where('user_id', $id)->orderBy('id', 'desc')->paginate(10);
        
        //写真があれば写真を表示
        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
            $is_image = true;
        }

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'microposts'=> $microposts,
            'is_image'=>$is_image,
        ]);
    }
    

    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);
        
        if (\Auth::id() === $user->id) {
            //写真があれば写真を表示
            $is_image = false;
            if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
                $is_image = true;
            }
            
            // メッセージ編集ビューでそれを表示
            return view('users.edit', [
                'user' => $user,
                'is_image'=>$is_image,
            ]);
        }
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'photo'=>'image|file|max:2048',
            'name'=>'required|max:30',
            'learning_language' => 'max:100',
            'shout_message' => 'max:50',
            'introduction' => 'max:500',
        ]);
        
        $user = User::findOrFail($id);
        
        $user->name= $request->name;
        $user->learning_language = $request->learning_language;
        $user->shout_message = $request->shout_message;
        $user->introduction= $request->introduction;
        
        $user->save();
        
        if ($request->photo) {
            //写真を指定したパスに保存する
            $request->photo->storeAs('public/profile_images', $id . '.jpg');
        }
        
        
        return back()->with('success', 'プロフィールを更新しました');
    }
    
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
}
