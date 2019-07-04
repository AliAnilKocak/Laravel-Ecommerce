@extends('layouts.master')
@section('title','Product')
@section('content')
<div class="container">
    <div class="bg-content">
        <h2>Siparişler</h2>
        @if (count($sellers) == 0)
        <p>Henüz siparişiniz yok</p>
        @else
        <table class="table table-bordererd table-hover">
            <tr>
                <th>Sipariş Kodu</th>
                <th>Sipariş Tutar</th>
                <th>Toplam Ürün</th>
                <th>Durum</th>
                <th></th>
            </tr>
            @foreach ($sellers as $seller)
            <tr>
                <td>SP-{{$seller->id}}</td>
                <td>{{$seller->price*((100+config('cart.tax'))/100)}}</td>
            <td>{{$seller->shoppingcart->shoppingCartProductAmount()}}</td>
                <td>{{$seller->status}}</td>
            <td><a href="{{route('seller',$seller->id)}}" class="btn btn-sm btn-success">Detay</a></td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>
</div>
@endsection
