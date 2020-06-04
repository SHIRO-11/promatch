@extends('layouts.app')

@section('head')
    <link rel="stylesheet"  href="/css/design.css">
    <script type="text/javascript" src="/js/js_design.js"></script> 
@endsection
    @section('content')
        @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
        @endif
            {!! Form::model($user, ['route' => ['users.update', $user->id],  'files' => true,'method' => 'put']) !!}
            
                <div class="form-group mt-4">
                    {!! Form::label('photo', 'プロフィール画像') !!}<br>
                    <img src="/storage/profile_images/{{ Auth::id() }}.jpg" width="300" height="303"><br>
                    {!! Form::file('photo', null,) !!}
                    
                </div>
            
                <div class="form-group mt-4">
                    {!! Form::label('name', 'アカウント名') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group mt-4">
                    {!! Form::label('learning_language', '学習中言語　(最大100文字)') !!}
                    {!! Form::text('learning_language', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('shout_message', '一言メッセージ　(最大50文字)') !!}
                    {!! Form::text('shout_message', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('introduction', '自己紹介　(最大500文字)') !!}
                    {!! Form::textarea('introduction', null, ['class' => 'form-control']) !!}
                </div>
        <div class="row">
            <div class="col-offset-1 col-1">
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!} 
            
            {!! link_to_route('users.show', '戻る',['user' => Auth::id()],['class' => 'btn btn-secondary']) !!}
        </div>
@endsection