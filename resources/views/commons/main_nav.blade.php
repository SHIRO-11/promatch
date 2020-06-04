<header>
    
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand"  href="/">Promacth</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- マイページへのリンク --}}
                <li class="nav-item"><a href="{{ route('users.show',  ['user' => Auth::id()]) }}" class="nav-link {{ Request::routeIs('users.show',  ['user' => Auth::id()]) ? 'active' : '' }}">マイページ</li>
                {{-- 友達へのリンク --}}
                <li class="nav-item"><a href="#" class="nav-link">友達</a></li>
                {{-- タイムラインへのリンク --}}
                <li class="nav-item"><a href="#" class="nav-link">タイムライン</a></li>
                {{-- チャットへのリンク --}}
                <li class="nav-item"><a href="#" class="nav-link">チャット</a></li>
                {{-- ログアウトへのリンク --}}
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link {{ Request::routeIs('logout') ? 'active' : '' }}">ログアウト</a></li>
            </ul>
        </div>
    </nav>
</header>