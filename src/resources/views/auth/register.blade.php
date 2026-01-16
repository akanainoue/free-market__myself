@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="content">
    <h2 class="ttl">会員登録</h2>
    <form action="/register" method="post">
        @csrf
        <div class="form__label">ユーザー名</div>
        <input class="form__input" type="text" name="name" value="{{old('name')}}">
        <div class="error-message">
            @error('name')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">メールアドレス</div>
        <input class="form__input" type="mail" name="email" value="{{old('email')}}">
        <div class="error-message">
            @error('email')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">パスワード</div>
        <input class="form__input" type="password" name="password" >
        <div class="error-message">
            @error('password')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">確認用パスワード</div>
        <input class="form__input" type="password" name="password_confirmation">
        <div class="error-message">
            @error('password_confirmation')
                {{$message}}
            @enderror
        </div>
        <div class="form__btn">
            <button class="register__btn" type="submit">登録する</button>
        </div>
        <div class="login">
            <a class="login__link" href="/login">ログインはこちら</a>
        </div>
    </form>
</div>
@endsection

