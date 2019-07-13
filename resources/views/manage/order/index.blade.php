@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Sipariş Yönetimi</h1>
@include('layouts.partials.alert')
<h3 class="sub-header">Siparişler</h3>
<div class="well">
    <div class="btn-group pull-right" role="group" aria-label="Basic example">
        <a href="{{route('manage.order.create')}}" class="btn btn-link"> + Yeni Sipariş</a>
    </div>
    <form method="POST" class="form-inline" action="{{route('manage.order')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="search_word">Ara</label>
            <input placeholder="Sipariş ara" value="{{old('search_word')}}" type="text"
                class="form-control form-control-sm" name="search_word" id="search_word">

        </div>
        <button class="btn btn-info" type="submit">Ara</button>
        <a class="btn btn-primary" href="{{route('manage.order')}}">Temizle</a>
    </form>
</div>


<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Ad Soyad</th>
                <th>Fiyat</th>
                <th>Durum</th>
                <th>Banka</th>
                <th>Adres</th>
                <th></th>
            </tr>
        </thead>
        <tbody>


            @if (count($list)==0)
            <h2 style="color:coral">Aradığınız özelliklere göre kategori bulunmamaktadır.</h2>
            <tr>
                @else

                @foreach ($list as $item)
                <td>{{$item->shoppingcart->user->full_name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->bank}}</td>
                <td>{{$item->adress}}</td>





                <td style="width: 100px">
                    <a href="{{route('manage.order.edit',$item->id)}}" class="btn btn-xs btn-success"
                        data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('manage.order.delete',$item->id)}}" class="btn btn-xs btn-danger"
                        data-toggle="tooltip" data-placement="top" title="Tooltip on top"
                        onclick="return confirm('Are you sure?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            @endif

        </tbody>
    </table>
    {{$list->links()}}
</div>
@endsection
