@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Ürün Yönetimi</h1>
<form enctype="multipart/form-data" method="post" action="{{route('manage.order.save',@$entry->id)}}">
    <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{@$entry->id>0 ? "Güncelle" : "Kaydet" }}
        </button>
    </div>
        {{ csrf_field() }}
        @include('layouts.partials.alert')
        @include('layouts.partials.errors')
        <div class="row">

            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="full_name" class="form-control" id="full_name"
                        value="{{old('full_name',$entry->full_name)}}" placeholder="İsim">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="price" class="form-control" id="price"
                        value="{{old('price',$entry->price)}}" placeholder="Fiyat">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="adress" class="form-control" id="adress"
                        value="{{old('adress',$entry->adress)}}" placeholder="Adres">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <textarea class="form-control" name="status" id="status" cols="50"
                        rows="1">{{old('status',$entry->status)}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <textarea class="form-control" name="bank" id="bank" cols="50"
                        rows="1">{{old('bank',$entry->bank)}}</textarea>
                </div>
            </div>
            <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Ürün</th>
                        <th>Tutar</th>
                        <th>Adet</th>
                        <th>Ara Toplam</th>
                        <th>Durum</th>
                    </tr>
                    @foreach ($entry->shoppingcart->shoppingcartProduct as $shoppingcartProduct)
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
                        <th colspan="2">{{$entry->price}} tl</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Toplam Tutar (KDVli)</th>
                        <th colspan="2">{{$entry->price*((100+config('cart.tax'))/100)}} tl</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Sipariş Durum</th>
                        <th colspan="2">{{$entry->status}} tl</th>
                    </tr>
                </table>

        </div>


</form>
@endsection



@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection

@section('footer')
<script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
    $(function(){
        $('#categories').select2({
            placeholder: 'Kategori seçiniz'
        });

        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
          };

        CKEDITOR.replace('description', options);
    });
</script>
@endsection
