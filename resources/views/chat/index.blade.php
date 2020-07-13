@extends('layouts.app')

@section('content')
<h2 class="mt-2">チャット</h2>
    <ul class="list-unstyled opacity">
        <div class="row mt-2">
            <div class="col-2">
                @foreach ($users as $user)
                    @if(in_array($user->id,Auth::user()->follow_each()))
                        <li class="media user-card mb-2">
                            <a href="{{ route('chats.show',  ['chat' => $user->id]) }}">
                                @if(file_exists(storage_path('/app/public/profile_images/') . $user->id .  '.jpg'))
                                <img src="/storage/profile_images/{{ $user->id }}.jpg" width="45" height="45">
                                @else
                                <img src="/images/default.png" width="45" height="45">
                                @endif
                            </a>
                            <div class="media-body ml-1">
                                <div>
                                    {{-- 名前を表示 --}}
                                    {!! link_to_route('chats.show', $user->name, ['chat' => $user->id]) !!}
                                </div>
                                
                            </div>
                        </li>
                    @endif
                @endforeach
            </div>
        </div>    
    </ul>
    
@endsection