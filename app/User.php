<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function microposts(){
        return $this->hasMany(Micropost::class);
    }
    
    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings(){
        return $this->belongsToMany(User::class,'user_follow','user_id','follow_id');
    }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers(){
        return $this->belongsToMany(User::class,'user_follow','follow_id','user_id');
    }
    
    
    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
     public function follow($userId){
         //既にフォローしているか確認
         $exist = $this->is_following($userId);
         //相手が自分自身かを確認
         $its_me= $this->id == $userId;
         
         if($exist ||$its_me){
             //既にフォローしていれば何もしない
             return false;
         }else{
             //未フォローであればフォローする
             $this->followings()->attach($userId);
             return true;
         }
     }
     
     /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
     public function unfollow($userId){
         //既にフォローして�����るか確認
         $exist = $this->is_following($userId);
         
         //相手が自分自身かどうか確認
         $its_me = $this->id == $userId;
         
         if($exist && !$its_me){
             //すでにフォローしていればアンフォロー
             $this->followings()->detach($userId);
             return true;
         }else{
             return false;
         }
     }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['microposts', 'followings', 'followers']);
    }
    
    
    /**
     * このユーザとフォロー中ユーザの投稿に絞り込む。
     */
    public function feed_microposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Micropost::whereIn('user_id', $userIds);
    }
    
    public function each_following($user){
        
        $following = false;
        $followed = false;
        
        //認証済みユーザが相手をフォローしているか確認
        // 認証済みのユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        
        //認証済みのユーザのフォローしている人の中に$userIdがいればtrueを返す
        if(in_array($user->id,$userIds)){
            $following = true;
        }
        
        //調べたい相手ユーザが認証済みユーザをフォローしているか確認
        //調べたい相手ユーザがフォロー中のユーザのidを取得して配列にする
        $other_userIds = $user->followings()->pluck('users.id')->toArray();
        
        //調べたい相手ユーザのフォローしている人の中に$userIdがいればtrueを返す
        if(in_array(Auth::id(),$other_userIds)){
            $followed = true;
        }
        
        
        //相互フォローだったらtrueを返す
        if($following && $followed){
            return true;
        }
    }
    
    public function are_followed(){
        //関数を呼び出すユーザがフォローしているユーザを取得
        $userIds = $this->followings()->pluck('users.id')->toArray();
        $userId = Auth::id();
        
        if(in_array($userId,$userIds)){
            return true;
        }else{
            return false;
        }
    }
}
