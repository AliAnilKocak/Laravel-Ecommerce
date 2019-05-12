@extends('layouts.master')
@section('title',$category->name)
@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{route('homepage')}}">Anasayfa</a></li>

        <li class="active">{{$category->name}}</li>
    </ol>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{$category->name}}</div>
                <div class="panel-body">
                    @if (count($products)>0)
                    <h3>Alt Kategoriler</h3>
                    <div class="list-group categories">
                        @foreach ($sub_categories as $sub_category)
                        <a href="{{route('category',$sub_category->slug)}}" class="list-group-item"><i
                                class="fa fa-television"></i>{{$sub_category->name}}</a>
                        @endforeach

                    </div>
                    @endif

                </div>
                {{request()->has('order') ? $products->appends(['order'=>request('order')])->links() : $products->links()}}
            </div>
        </div>
        <div class="col-md-9">
            <div class="products bg-content">
                @if (count($products)>0)
                Sırala
                <a href="?order=mostsellers" class="btn btn-default">Çok Satanlar</a>
                <a href="?order=featured" class="btn btn-default">Yeni Ürünler</a>
                <hr>

                @endif

                <div class="row">
                    @if (count($products)==0)
                    <div class="col-md-12">Bu kategoriye ait ürün bulunmamaktadır.</div>
                    @endif
                    @foreach ($products as $product)
                    <div class="col-md-3 product">
                        <a href="{{route('product',$product->slug)}}"><img
                                src="http://lorempixel.com/400/400/food/1"></a>
                        <p><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></p>
                        <p class="price">{{$product->price}} ₺</p>
                        <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
