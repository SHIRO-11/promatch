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
                {{-- Promacthとはへのリンク --}}
                <li class="nav-item"><a href="/#about" class="nav-link">Promacthとは</a></li>
                {{-- 概要へのリンク --}}
                <li class="nav-item"><a href="/#service" class="nav-link">概要</a></li>
                {{-- コンセプトへのリンク --}}
                <li class="nav-item"><a href="/#concept" class="nav-link">コンセプト</a></li>
                {{-- 無料登録へのリンク --}}
                <li class="nav-item"><a href="/#resister" class="nav-link">無料登録</a></li>
                {{-- ログインページへのリンク --}}
                <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
            </ul>
        </div>
    </nav>
</header>