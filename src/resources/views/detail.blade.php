@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
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
<div class="product-detail-container">
    <div class="product-image">
        <img src="{{ asset('storage/items/' . $product->image) }}" alt="商品画像">
    </div>

    <div class="product-info">
        <h2 class="product-title">{{ $product->name }}</h2>
        <p class="brand-name">{{ $product->brand_name }}</p>
        <p class="price">¥{{ number_format($product->price) }} <span>（税込）</span></p>

        <div class="icon-row">
            <div class="icon-block">
                <form class="icon" action="/item/{{ $product->id }}/like" method="POST">
                    @csrf
                    <button type="submit" class="like-button">
                        <img src="{{asset('items/heart.png')}}" alt="herat-icon">
                    </button>
                </form>
                <div class="count">{{ $product->likes_count }}</div>
            </div>
            <div class="icon-block">
                <span class="icon comment"><img src="{{asset('items/speech-bubble.png')}}" alt="speech-bubble"></span> 
                <div class="count comment">{{ $product->reviews->count() }}</div>
            </div>
        </div>
        <!-- 個人的には下のカウント法が好き -->
        <a href="/purchase/{{$product->id}}" class="purchase-button">購入手続きへ</a>

        <h3 class="section-title">商品説明</h3>
        <p>{!! nl2br(e($product->description)) !!}</p>

        <h3 class="section-title">商品の情報</h3>
        <p class="section-category">
            <strong>カテゴリー</strong>
            <div class="category-list">
                @foreach ($product->categories as $category)
                <span class="category-name">
                    {{ $category->name }}
                </span>
                @endforeach
            </div>
        </p>
        <p class="section-condition">
            <strong>商品の状態</strong>
            <span>{{ $product->condition->name }}</span>
        </p>

        <h3 class="section-title">コメント({{ $product->reviews->count() }})</h3>
        @foreach($product->reviews as $review)
            <div class="comment">
                <div class="user-info">
                    <img class="profile-img" src="{{ asset('storage/' . $review->user->profile_image) }}">
                    <strong>{{ $review->user->name }}</strong>
                </div>
                <p class="comment-body">{{ $review->comment }}</p>
            </div>
        @endforeach

        @auth
        <form class="comment-form" action="/item/{{ $product->id }}/review" method="POST">
            @csrf
            <label>商品へのコメント</label>
            <textarea name="comment" rows="10" class="form-textarea" required></textarea>
            <button type="submit" class="comment-submit">コメントを送信する</button>
        </form>
        @endauth
    </div>
</div>
@endsection