<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Micropost;
use App\User;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザとフォロー中ユーザの投稿の一覧を作成日時の降順で取得
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'microposts' => $microposts,
                'user' => $user,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function store(Request $request){
        //バリデーション
        $request->validate([
            'content' => 'required|max:10000',
        ]);
        
        $request->user()->microposts()->create([
            'content'=>$request->content,]);
            
            return back();
    }
    
    public function destroy($id){
        //idで投稿を検索
        $micropost = Micropost::findOrFail($id);
        
        //認証済みユーザか確認
        if(Auth::id() === $micropost->user_id){
            $micropost ->delete();
        }
        
        return back();
    }
    
    public function all(){
        //認証済みユーザを取得
        $user = Auth::user();
        
        //全投稿を取得
        $microposts = Micropost::orderBy('id','desc')->paginate(10);
        
         // ユーザ一覧ビューでそれを表示
        return view('microposts.all', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
}
