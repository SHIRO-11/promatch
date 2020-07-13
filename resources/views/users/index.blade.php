@extends('layouts.app')


@section('content')

    <a href="#" onclick="history.back(); return false;" class="btn btn-primary mt-4 mb-4">戻る</a>
    @if (count($users) > 0)
        <ul class="list-unstyled opacity">
            @foreach ($users as $user)
                <li class="media user-card mb-2">
                    <a href="{{ route('users.show',  ['user' => $user->id]) }}">
                        @if(file_exists(storage_path('/app/public/profile_images/') . $user->id .  '.jpg'))
                        <img src="/storage/profile_images/{{ $user->id }}.jpg" width="64" height="64">
                        @else
                        <img src="/images/default.png" width="64" height="64">
                        @endif
                    </a>
                    <div class="media-body ml-1">
                        <div>
                            {{-- 名前を表示 --}}
                            {!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}
                            @if($user->are_followed())
                            あなたをフォローしています。
                            @endif
                        </div>
                        
                        <div class="button hvr-sweep-to-right">
                            {{-- 学習中言語 --}}
                            学習中言語：{{$user->learning_language}}
                        </div><br>
                        
                        <div class="button hvr-sweep-to-right">
                            {{-- 一言メッセージを表示 --}}
                            一言：{{$user->shout_message}}
                        </div>
                        
                        <div class="div-box-30">
                            @include('commons.follow_button')
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $users->links() }}
    @endif
 
@endsection