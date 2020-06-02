@extends('layouts.app')

@section('head')
    <link rel="stylesheet"  href="../css/design.css">
    <script type="text/javascript" src="/js/js_design.js"></script> 
@endsection

@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('commons.side_nav')
            </div>
            
            <div class="col-md-10">
                {!! Form::open(['route' => 'logout']) !!}
                    {!! Form::submit('logout') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@else
    @section('content')
        <div class="row text-center" id="head">
            <div class="col">
                <div id="head-promatch">
                    <h1>Promatch</h1>
                    〜プログラミング学習者向けマッチングアプリ〜
                </div>
            </div>
        </div>
        
        <div class="row text-center" id="about">
           <div class="col-md-7">
               <div class="fadein" id='about-text'>
                   <h2>Promatchとは</h2> 
                   Promatchはプログラミングを学習中の人達が互いに助け合い、<br>
                   共に成長できる環境を提供することを目的に作成された<br>
                   プログラミング学習者向けのマッチングアプリです。
                   <br><br>
                   投稿、フォロー、タイムラインなどSNSの基本となる機能は<br>もちろんのこと、投稿やチャットでは
                   <br>コードブロックを利用することが可能。
                   <br><br>
                   ぜひPromatchを利用して、気の合う仲間・ライバルを見つけて<br>プログラミング学習を楽しみましょう!
                </div>
               
           </div>
           <div class="col-md-5">
           <img id="about-image" src="/images/match.jpg">
           </div>
        </div>
        
        <div class="row" id="service">
            <div class="row col-12 text-center">
                <div class="col">
                    <h2 class="fadein-speed">サービス概要</h2>
                </div>
            </div>
            
            <div class="row col-12 fadein">
                <div class="offset-md-2 col-md-2 col-12 text-center">
                    <img id="service-image" src="/images/register.png">
                </div>
                
                <div class="offset-md-2 col-md-5">
                    <div class="white-box">
                        <h3>①簡単無料登録</h3>
                        3分程度で終わる簡単な登録作業をしましょう。
                        必要な項目は「名前（ニックネーム）」「メールアドレス」「パスワード」の3点のみです。
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row text-center" id="concept">
            <div class="col">
                <h2>コンセプト</h2>
                近年エンジニアの需要が伸びていますが、プログラミングを独学で習得するのは難しく、挫折してしまう人が多いです。<br>
               しかし、プログラミングスクールは数十万円と費用がかかるため誰でも通えるわけではありません。<br>
              
               そんな人達でも
            </div>
        </div>
        
        <div class="row text-center" id="resister">
            <div class="col">
                <h2>無料登録</h2>
                @include('commons.register')
            </div>
        </div>
    @endsection
@endif