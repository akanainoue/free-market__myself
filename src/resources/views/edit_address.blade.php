@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/edit_address.css')}}">
@endsection

@section('content')
<div class="content">
    <h2 class="ttl">住所の変更</h2>
    <form action="/purchase/address/{{$item_id}}" method="post">
        @csrf
        @method('PUT')
        <div class="form__label">郵便番号</div>
        <input class="form__input" type="text" name="delivery_postal_code" value="{{old('delivery_postal_code', $user->postal_code)}}">
        <div class="error-message">
            @error('delivery_postal_code')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">住所</div>
        <input class="form__input" type="text" name="delivery_address" value="{{old('delivery_address',$user->address)}}">
        <div class="error-message">
            @error('delivery_address')
                {{$message}}
            @enderror
        </div>
        <div class="form__label">建物名</div>
        <input class="form__input" type="text" name="delivery_building_name" value="{{old('delivery_building_name', $user->building_name)}}">
        <div class="error-message">
            @error('delivery_building_name')
                {{$message}}
            @enderror
        </div>
        <div class="form__btn">
            <button class="register__btn" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection