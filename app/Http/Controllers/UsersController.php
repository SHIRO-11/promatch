<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;  
use Illuminate\Support\Facades\Storage; //画像を表示するためにStorageを使う


class UsersController extends Controller
{
        public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);
        
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
    
    public function update(Request $request,$id){
        // バリデーション
        $request->validate([
            'photo'=>'required|image|file|max:2048',
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
        
        //写真を指定したパスに保存する
        $request->photo->storeAs('public/profile_images', $id . '.jpg');
        
        return back()->with('success', 'プロフィールを更新しました');
    }
}
