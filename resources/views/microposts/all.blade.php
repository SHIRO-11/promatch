@extends('layouts.app')

@if(Auth::check())
    @section('content')
        <div class="mt-2 mb-2">
        {!! link_to_route('/', 'フォロー中ユーザーの投稿', [],['class'=>'btn btn-secondary']) !!}
        {!! link_to_route('microposts.all', '全ユーザーの投稿', [],['class'=>'btn btn-primary']) !!}
        </div>
        <h2 class="slideInRight-slow">全ユーザーの投稿</h2>
        <ul class="list-unstyled opacity">
            @foreach ($microposts as $micropost)
                <li class="media user-card mb-2">
                    <a href="{{ route('users.show',  ['user' => $micropost->user->id]) }}" class="align-self-start mr-3">
                        @if(file_exists(storage_path('/app/public/profile_images/') . $micropost->user->id .  '.jpg'))
                        <img src="/storage/profile_images/{{ $micropost->user->id }}.jpg" width="64" height="64">
                        @else
                        <img src="/images/default.png" width="64" height="64">
                        @endif
                    </a>
                    <div class="media-body">
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
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
        </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
    
    {!! Form::open(['route' => 'microposts.store']) !!}
    <div class="form-group">
        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
    {!! Form::close() !!}
    @endsection
@endif