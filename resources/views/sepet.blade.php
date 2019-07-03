@extends('layouts.master')
@section('title','Sepet')
@section('content')
<div class="container">
    <div class="bg-content">
        <h2>Sepet</h2>
        @include('layouts.partials.alert')
        <table class="table table-bordererd table-hover">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Adet fiyatı</th>
                <th>Adet</th>
                <th>Tutar</th>
            </tr>
            @foreach (Cart::content() as $productCartItem)

            <tr>
                <td style="width:120px;">
                    <img src="http://lorempixel.com/120/100/food/2">
                </td>
                <td>{{$productCartItem->name}}

                    <form style="margin-top: 20px;" action="{{route('shoppingcart.remove',$productCartItem->rowId)}}"
                        method="post">
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}

                        <input type="submit" class="btn btn-danger btn-xs" value="Sepetten kaldır.">
                    </form>
                </td>



                <td>{{$productCartItem->price}} TL</td>

                <td>
                    <a href="#" data-id="{{$productCartItem->rowId}}" data-count="{{$productCartItem->qty-1}}"
                        class="btn btn-xs btn-default product-count-increment">-</a>
                    <span style="padding: 10px 20px">{{$productCartItem->qty}}</span>
                    <a data-id="{{$productCartItem->rowId}}" data-count="{{$productCartItem->qty+1}}" href=" #"
                        class="btn btn-xs btn-default product-count-decrement">+</a>
                </td>

                <td class="text-right">
                    {{$productCartItem->subtotal}}
                </td>
            </tr>
            @endforeach

            <tr>
                <th colspan="4" class="text-right">Alt Toplam</th>
                <th>{{Cart::subtotal()}} tl</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">KDV</th>
                <th>{{Cart::tax()}} tl</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Genel Toplam</th>
                <th>{{Cart::total()}} tl</th>
            </tr>
        </table>
        <div>


            <form style="margin-top: 20px;" action="{{route('shoppingcart.remove_all')}}" method="post">
                {{ csrf_field() }}
                {{method_field('DELETE')}}

                <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
            </form>
        <a href="{{route('pay')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
        </div>
    </div>
</div>

@endsection


@section('footer')
<script>
    $(function(){
        $('.product-count-increment, .product-count-decrement').click(function() {
    var id = $(this).attr('data-id'); //view kısmında belirttik
    var count = $(this).attr('data-count');
    alert("sdf");
    $.ajax({
        type: 'PATCH',
        url: '{{url('shoppingcart/update')}}/' + id,
        data: { count: count },
        success: function() {
            //if(result == 'success') Buradaki yukarıdan gelen result değişkeni shopping cart controler içerisindeki update moetodunun içindeki
            //response()->json(['success'=>true]) kısmından gelebilmektedir.
            window.location.href = '{{route('shoppingcart')}}';
        }
    });
});
    });
</script>
@endsection
