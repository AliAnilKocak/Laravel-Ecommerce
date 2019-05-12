@extends('layouts.master')
@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{route('homepage')}}">Anasayfa</a></li>
        <li class="active">Arama Sonucu</li>
    </ol>
    <div class="products bg-content">
        <div class="row">
            @if (count($products) == 0)
            <div class="col-md-12 text-center">
                Ürün bulunamadı.
            </div>


            @endif
            @foreach ($products as $product)
            <div class="col-md-3 product">
                <a href="{{route('product',$product->slug)}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                <p><a href="{{route('product',$product->slug)}}">{{$product->name}}</a>
                </p>
                <p class="price">{{$product->price}} ₺</p>
            </div>
            @endforeach
        </div>
        {{$products->appends(['searched'=>old('searched')])->links()}}
    </div>
</div>
@endsection
