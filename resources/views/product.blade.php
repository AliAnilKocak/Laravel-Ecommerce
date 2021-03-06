@extends('layouts.master')
@section('title',$product->name)
@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">Anasayfa</a></li>
        @foreach ($categories as $categorie)
        <li><a href="{{route('category',$categorie->name)}}">{{$categorie->name}}</a></li>
        @endforeach

        <li class="active">{{$product->name}}</li>
    </ol>
    <div class="bg-content">
        <div class="row">
            <div class="col-md-5">
                <img src="https://i.gadgets360cdn.com/products/large/1531976003_635_mi_max_3_db.jpg">
                <hr>
                <div class="row">
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail"><img src="http://lorempixel.com/60/60/food/2"></a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail"><img src="http://lorempixel.com/60/60/food/3"></a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail"><img src="http://lorempixel.com/60/60/food/4"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h1>{{$product->name}}</h1>
                <p class="price">{{$product->price}} ₺</p>

                <form method="POST" action="{{route('shoppingcart.add')}}">
                    {{ csrf_field()   }}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input value="Sepete Ekle" type="submit" class="btn btn-theme">
                </form>

            </div>
        </div>

        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#t1" data-toggle="tab">{{$product->description}}</a>
                </li>
                <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="t1">t1</div>
                <div role="tabpanel" class="tab-pane" id="t2">t2</div>
            </div>
        </div>

    </div>
</div>
@endsection
