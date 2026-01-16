@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/edit_profile.css')}}">
@endsection

@section('nav')
<div class="form-search">
    <form action="/" method="get">
        <input class="keyword-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ old('keyword') }}" >
    </form>
</div>
<div class="nav-buttons">
    @if (Auth::check())
    <form class="logout__btn" action="/logout" method="post">
        @csrf
        <button class="btn--a">ログアウト</button>
    </form>
    @else
    <form class="login__btn" action="/login" method="post">
        @csrf
        <button class="btn--a">ログイン</button>
    </form>
    @endif
    <form action="/mypage" class="mypage-link" method="get">
        <button class="btn--a">マイページ</button>
    </form>
    <form action="/sell" class="sell-link" method="get">
        <button class="btn--b">出品</button>
    </form>
</div>
@endsection

@section('content')
<div class="content">
    <h2 class="ttl">プロフィール設定</h2>
    <form action="/mypage/profile" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="image-upload-section">
            <img class="profile-img" src="{{ asset('storage/' . $user->profile_image) }}">
            <label class="image-select-btn">
                画像を選択する
                <input type="file" name="profile_image" hidden>
            </label>
            <p class="error-message">
            @error('profile_image')
            {{ $message }}
            @enderror
            </p>
        </div>
        <div class="form__label">ユーザー名</div>
        <input class="form__input" type="text" name="name" value="{{$user->name}}">
        <div class="error-message">
            @error('name')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">郵便番号</div>
        <input class="form__input" type="text" name="postal_code" value="{{old('postal_code')}}">
        <div class="error-message">
            @error('postal_code')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">住所</div>
        <input class="form__input" type="text" name="address" value="{{old('address')}}" >
        <div class="error-message">
            @error('address')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">建物名</div>
        <input class="form__input" type="text" name="building_name" value="{{old('building_name')}}">
        <div class="error-message">
            @error('building_name')
                {{$message}}
            @enderror
        </div>
        <div class="form__btn">
            <button class="register__btn" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection