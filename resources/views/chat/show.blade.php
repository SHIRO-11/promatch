@extends('layouts.app')
@section('head')
    <script type="text/javascript" src="/js/js_design.js"></script> 
@endsection

@section('content')
<h2 class="mt-2">{{$user->name}}さんとのチャット</h2>

    <ul class="list-unstyled opacity">
        <div class="row mt-2">
            <div class="col-2">
                @foreach ($users as $user_a)
                    @if(in_array($user_a->id,Auth::user()->follow_each()))
                        <li class="media user-card mb-2">
                            <a href="{{ route('chats.show',  ['chat' => $user_a->id]) }}">
                                @if(file_exists(storage_path('/app/public/profile_images/') . $user_a->id .  '.jpg'))
                                <img src="/storage/profile_images/{{ $user_a->id }}.jpg" width="45" height="45">
                                @else
                                <img src="/images/default.png" width="45" height="45">
                                @endif
                            </a>
                            <div class="media-body ml-1">
                                <div>
                                    {{-- 名前を表示 --}}
                                    {!! link_to_route('chats.show', $user_a->name, ['chat' => $user_a->id]) !!}
                                </div>
                                
                            </div>
                        </li>
                    @endif
                @endforeach
            </div>
            
            <div class="col-10 scroll-box">
                    @foreach(Auth::user()->chat($user->id) as $chat)
                        @if($chat['id'] === $user->id)
                            <div class="chat" align="left">
                                <div class="text-left">{{$chat['name']}}<br></div>
                                <div class="mb-2 chat-content-partner">{{$chat['content']}}</div>
                            </div>
                        @else
                            <div class="chat" align="right">
                                <div>{{$chat['name']}}<br></div>
                                <div class="mb-2 chat-content" align="left">{{$chat['content']}}</div>
                            </div>
                        @endif
                    @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                {!! Form::open(['route' => 'chats.store']) !!}
                    <div class="form-group align-items-end">
                        {!! Form::textarea('content', '', ['class' => 'form-control', 'rows' => '2']) !!}
                        {{Form::hidden('user_id', $user->id)}}
                        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </ul>
    
@endsection