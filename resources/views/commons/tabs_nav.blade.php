<ul class="nav nav-tabs">
    <li class="nav-item"><a href="{{ route('users.followings',  ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings', ['id' => $user->id]) && (Auth::id() == $user->id) ? 'active' : '' }}">フォロー中</a></li>
    <li class="nav-item"><a href="#" class="nav-link">フォロワー</a></li>
    <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link {{ Request::routeIs('users.followings', ['id' => $user->id]) && (Auth::id() == $user->id) ? 'active' : '' }}">全ユーザー</a></li>
</ul>