@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
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
<div class="mypage-container">
    <div class="profile-section">
        <div class="profile-info-wrapper">
            <img class="profile-image" src="{{ asset('storage/profile_image/' . $user->profile_image) }}" alt="" class="profile-img">
        </div>
        <div class="edit-link-wrapper">
            <span class="name">{{ $user->name }}</span>
            <a href="/mypage/profile/edit" class="edit-profile-button">プロフィールを編集</a>
        </div>
    </div>

    <div class="tab-menu">
        <a href="/mypage?page=sell" class="{{ $page === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="/mypage?page=buy" class="{{ $page === 'buy' ? 'active' : '' }}">購入した商品</a>
    </div>

    <div class="item-list">
        @if($page === 'sell')
            @foreach($products as $product)
                <div class="item">
                    <img class="item-image" src="{{ asset('storage/items/' . $product->image) }}" alt="商品画像">
                    <div>{{ $product->name }}</div>
                </div>
            @endforeach
        @elseif($page === 'buy')
            @foreach($purchases as $purchase)
                <div class="item">
                    <img class="item-image" src="{{ asset('storage/items/' . $purchase->product->image) }}" alt="商品画像">
                    <div>{{ $purchase->product->name }}</div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
