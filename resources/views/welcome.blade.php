@extends('layouts.app')

@section('head')
    <link rel="stylesheet"  href="/css/design.css">
    <script type="text/javascript" src="/js/js_design.js"></script> 
@endsection

@if(Auth::check())
    @foreach($microposts as $micropost)
        <div>
            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
            {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
            <span class="text-muted">posted at {{ $micropost->created_at }}</span>
        </div>
        <div>
            {{-- 投稿内容 --}}
            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
        </div>
    @endforeach
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
    
@else
    @section('content')
    
        {{-- ヘッダー --}}
        <div class="row text-center" id="head">
            <div class="col">
                <div id="head-promatch">
                    <h1>Promatch</h1>
                    〜プログラミング学習者向けマッチングアプリ〜
                </div>
            </div>
        </div>
        
        
        {{-- Promacthとは --}}
        <div class="row text-center" id="about">
            
            <div class="col-md-5 order-md-last">
               <img id="about-image" src="/images/match.jpg">
            </div>
           
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
        </div>
        
         {{-- 概要 --}}
        <div class="row" id="service">
            <div class="row col-12 text-center">
                <div class="col">
                    <h2 class="fadein-speed">サービス概要</h2>
                </div>
            </div>
            
            {{-- 概要①--}}
            <div class="row col-12 fadein service-block">
                
                <div class="offset-md-3 col-md-2 col-12 text-center">
                    <img id="service-image" src="/images/register.png">
                </div>
                
                <div class="offset-md-1 col-md-5">
                    <div class="white-box">
                        <h3>①簡単無料登録</h3>
                        3分程度で終わる簡単な登録作業をしましょう。
                        必要な項目は「名前（ニックネーム）」「メールアドレス」「パスワード」の3点のみです。
                    </div>
                </div>
                
            </div>
            
            {{-- 概要② --}}
            <div class="row col-12 fadein service-block">
                <div class="offset-md-1 col-md-2 col-12 text-center order-md-last">
                    <img id="service-image" src="/images/human.png">
                </div>
                
                <div class="offset-md-2 col-md-5">
                    <div class="white-box">
                        <h3>②仲間・ライバルを探す</h3>
                        タイムラインやユーザ一覧から共通の言語を学習中の人、年代・性別が同じ人、
                        仲良くなりたい人など、友達になりたい人を探しましょう！
                    </div>
                </div>
            </div>
            
            
            {{-- 概要③ --}}
            <div class="row col-12 fadein service-block">
                <div class="offset-md-3 col-md-2 col-12 text-center">
                    <img id="service-image" src="/images/chat.png">
                </div>
                
                <div class="offset-md-1 col-md-5">
                    <div class="white-box">
                        <h3>③友達と相談・雑談</h3>
                        プログラミングを勉強していてわからないところを<br>質問したり、
                        雑談などをして自由に楽しみましょう！
                    </div>
                </div>
            </div>
        </div>
        
        
        
        {{-- コンセプト --}}
        <div class="row text-center" id="concept">
            
            <div class="col-md-5">
               <img id="concept-image" src="/images/concept.jpeg">
            </div>
           
           <div class="col-md-7">
               <div class="fadein" id='concept-text'>
                <h2>コンセプト</h2>
                    近年エンジニアの需要が伸びていますが、プログラミングを独学で
                    習得することは難しく挫折してしまう人は多いです。また、プログラミングスクールは数十万円と費用がかかるため受講を
                    ためらってしまう人も多いはずです。<br><br>
                    
                    しかし、何とかして1人でも多くの方にプログラミングの楽しさを
                    知ってもらいたく、考えた末に誕生したのが「Promacth」です。<br><br>
                    
                    挫折してしまう人の多くは難しいプログラミングを『独り』で
                    頑張っている場合が多いです。確かにそれは素晴らしいですが、せっかくなら仲間と一緒に頑張った方が楽しく、共に成長でき、挫折もしにくいはずです。<br>
                    
                    <br>
                </div>
               
           </div>
        </div>
        
        
        {{-- 登録 --}}
        <div class="row text-center" id="resister">
            <div class="col">
                <h2>無料登録</h2>
                @include('commons.register')
            </div>
        </div>
    @endsection
@endif