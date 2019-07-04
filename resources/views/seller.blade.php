@extends('layouts.master')
@section('title','Product')
@section('content')
<div class="container">
    <div class="bg-content">
        <h2>Sipariş (SP-{{$sellerDetail->id}})</h2>
        <table class="table table-bordererd table-hover">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Tutar</th>
                <th>Adet</th>
                <th>Ara Toplam</th>
                <th>Durum</th>
            </tr>
            @foreach ($sellerDetail->shoppingcart->shoppingcartProduct as $shoppingcartProduct)
            <tr>
                <td style="width:120px"> <img src="http://lorempixel.com/120/100/food/2"> Ürün adı</td>
                <td>   <a href="{{route('product',$shoppingcartProduct->product->slug)}}">{{$shoppingcartProduct->product->name}}</a> </td>

                <td>{{$shoppingcartProduct->price}}</td>
                <td>{{$shoppingcartProduct->count}}</td>
                <td>{{$shoppingcartProduct->count* $shoppingcartProduct->price}}</td>
                <td>
                    {{$shoppingcartProduct->status}}
                </td>
            </tr>
            @endforeach

            <tr>
                <th colspan="4" class="text-right">Toplam Tutar</th>
                <th colspan="2">{{$sellerDetail->price}} tl</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Toplam Tutar (KDVli)</th>
                <th colspan="2">{{$sellerDetail->price*((100+config('cart.tax'))/100)}} tl</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Sipariş Durum</th>
                <th colspan="2">{{$sellerDetail->status}} tl</th>
            </tr>
        </table>
    </div>
</div>
@endsection
