@extends('layouts.app')

@section('head')
    <link rel="stylesheet"  href="/css/design.css">
    <script type="text/javascript" src="/js/js_design.js"></script> 
@endsection
    @section('content')
        <h2 class="mt-4">{{$user->name}}</h2><br>
        <img src="/storage/profile_images/{{ Auth::id() }}.jpg" width="300" height="303"><br>
        
        <div class="mt-4">学習中言語</div>
        <div class="profile-learning-box">
            {{$user->learning_language}}
        </div><br>
        
        一言メッセージ（ユーザ一覧で表示されます。）<br>
        <div class="profile-shout-box">
        {{$user->shout_message}}
        </div><br>
        
        自己紹介<br>
        <div class="profile-introduction-box">
        {{$user->introduction}}
        </div><br>
        
        {!! link_to_route('users.edit', '編集する',['user' => Auth::id()],) !!}
    
    @endsection