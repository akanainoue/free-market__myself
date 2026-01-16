@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="content">
    <h2 class="ttl">ログイン</h2>
    <form action="/login" method="post">
        @csrf
        <div class="form__label">メールアドレス</div>
        <input class="form__input" type="mail" name="email" value="{{ old('email') }}">
        <div class="error-message">
            @error('email')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">パスワード</div>
        <input class="form__input" type="password" name="password">
        <div class="error-message">
            @error('password')
                {{$message}}
            @enderror
        </div>
        <div class="form__btn">
            <button class="register__btn" type="submit">ログインする</button>
        </div>
        <div class="register">
            <a class="register__link" href="/register">会員登録はこちら</a>
        </div>
    </form>
</div>
@endsection
