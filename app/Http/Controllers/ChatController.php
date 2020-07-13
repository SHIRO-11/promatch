<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class ChatController extends Controller
{
    public function index(){
        $users = User::orderBy('id',"desc")->get();
        
        
        return view('chat.index',[
            'users' =>$users,
            ]);
    }
    
    public function show($id){
        $users = User::orderBy('id',"desc")->get();
        $user = User::findOrFail($id);
        
        
        return view('chat.show',[
            'users' =>$users,
            'user' =>$user,
            ]);
        
    }
    
    public function store(Request $request){
        $request->validate([
            'content' => 'required|max:1000',
        ]);
        
        Auth::user()->storeChat($request->user_id,$request->content);
        return back();
    }
    
    
    
}
