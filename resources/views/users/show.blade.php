@extends('layouts.app')
    @section('content')
        <div class="row">
            <div class="col-md-3 opacity">
                @if(file_exists(storage_path('/app/public/profile_images/') . $user->id .  '.jpg'))
                    <img src="/storage/profile_images/{{ $user->id }}.jpg" width="200" height="200">
                @else
                    <img src="/images/default.png" width="200" height="200">
                @endif
                {!! link_to_route('users.followings', 'フォロー中',['id' => $user->id],['class' => 'btn btn-secondary mb-3']) !!}
                {!! link_to_route('users.followers', 'フォロワー',['id' => $user->id],['class' => 'btn btn-secondary mb-3']) !!}
                @include('commons.follow_button')
                
                @if(in_array($user->id,Auth::user()->follow_each()))
                {!! link_to_route('chats.show', 'チャット', ['chat'=>$user->id],['class'=>'btn btn-primary btn-block mt-2']) !!}
                @endif
            </div>
            <div class="col-md-6 mt-4">
                <h2 class="slideInRight">{{$user->name}}</h2>
                
                <div class="slideInRight-second">
                    {{--学習中言語--}}
                    学習中言語
                    @if($user->learning_language !== null)
                        <div class="profile-learning-box">
                            {{$user->learning_language}}
                        </div><br>
                    @else
                        <div class="profile-null-box"></div>
                    @endif
                </div>
                
                <div class="slideInRight-third">
                    一言メッセージ（ユーザ一覧で表示されます。）<br>
                    @if($user->shout_message !== null)
                    <div class="profile-shout-box">
                    {{$user->shout_message}}
                    </div><br>
                    @else
                        <div class="profile-null-box"></div>
                    @endif
                </div>
                
                <div class="slideInRight-forth">
                    自己紹介<br>
                    @if($user->introduction !== null)
                    <div class="profile-introduction-box">
                    {{$user->introduction}}
                    </div><br>
                    @else
                        <div class="profile-null-box"></div>
                    @endif
                </div>
                
                <div class="slideInRight-fifth">
                    @if (Auth::id() == $user->id)
                        {!! link_to_route('users.edit', '編集する',['user' => Auth::id()],['class' => 'btn btn-primary']) !!}
                    @endif
                </div>
            </div>
        </div>
        
        @foreach($microposts as $micropost)
            <li class="media user-card mb-2 mt-4 opacity">
                    <a href="{{ route('users.show',  ['user' => $user->id]) }}" class="align-self-start mr-3">
                        <img src="/storage/profile_images/{{ $user->id }}.jpg" width="64" height="64">
                    </a>
                    <div class="media-body">
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}
                            投稿日 {{ $micropost->created_at }}
                        </div>
                        
                        <div>
                            {{-- 投稿内容 --}}
                            {!! nl2br(e($micropost->content)) !!}
                            
                        </div>
                        
                        <div class="text-right">
                            @if (Auth::id() == $micropost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        </div>
                    </div>
                </li>
        @endforeach
        
        {{--ページネーションへのリンク--}}
        {{$microposts->links()}}
        
        
    @endsection