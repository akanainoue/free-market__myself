@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
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
<div class="container">
    <h2 class="title">商品の出品</h2>

    <form action="/sell" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
        <div class="product-image">
            <label class="form-label">商品画像</label>
            <div class="image-upload">
                <label class="image-select-btn">
                    画像を選択する
                    <input type="file" name="image" hidden>
                </label>
            </div>
            <p class="form__error-message">
                @error('image')
                {{ $message }}
                @enderror
            </p>
        </div>

        <h3 class="section-title">商品の詳細</h3>

        <div class="product-category">
            <label class="form-label">カテゴリー</label>
            <div class="category-buttons">
                @foreach($categories as $category)
                    <input type="checkbox" id="{{ $category->id }}" name="category_id[]" value="{{ $category->id }}" {{ in_array($category->id, old('category_id', [])) ? 'checked' : '' }} hidden>
                    <label for="{{ $category->id }}" class="category-option">
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
            <p class="form__error-message">
                @error('category_id')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="product-condition">
            <label class="form-label">商品の状態</label>
            <select name="condition_id" class="form-select">
                <option value="">選択してください</option>
                @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>{{ $condition->name }}</option>
                @endforeach
            </select>
            <p class="form__error-message">
                @error('condition_id')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="product-name">
            <label class="form-label">商品名</label>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}">
            <p class="form__error-message">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="brand-name">
            <label class="form-label">ブランド名</label>
            <input type="text" name="brand_name" class="form-input" value="{{ old('brand_name') }}">
        </div>

        <div class="product-description">
            <label class="form-label">商品の説明</label>
            <textarea name="description" class="form-textarea">{{ old('description') }}</textarea>
            <p class="form__error-message">
                @error('description')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="product-price">
            <label class="form-label">販売価格</label>
            <input type="number" name="price" class="form-input" placeholder="¥" value="{{ old('price') }}">
            <p class="form__error-message">
                @error('price')
                {{ $message }}
                @enderror
            </p>
        </div>

        <button type="submit" class="submit-button">出品する</button>
    </form>
</div>
@endsection
