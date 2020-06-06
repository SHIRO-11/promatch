<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Promatch</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet"  href="/css/design.css">
        <link rel="stylesheet"  href="/css/animation.css">
        <script type="text/javascript" src="/js/js_design.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        @yield('head')
    </head>

    <body>
        @if(!Auth::check())
            {{-- ナビゲーションバー --}}
            @include('commons.top_nav')
        @else
            @include('commons.main_nav')
        @endif

        <div class="container-fluid">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')
            @yield('content')
            
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>