@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Ürün Yönetimi</h1>
<form method="post" action="{{route('manage.product.save',@$entry->id)}}">
    <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{@$entry->id>0 ? "Güncelle" : "Kaydet" }}
        </button>
    </div>
    <h3 class="sub-header">{{@$entry->id>0 ? "Güncelleme" : "Yeni Kayıt" }} formu </h1>
        {{ csrf_field() }}
        @include('layouts.partials.alert')
        @include('layouts.partials.errors')
        <div class="row">

            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name',$entry->name)}}"
                        placeholder="Ürün ismi">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="slug" class="form-control" id="slug" value="{{old('slug',$entry->slug)}}"
                        placeholder="Slug ismi">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="price" class="form-control" id="price"
                        value="{{old('price',$entry->price)}}" placeholder="Ürün fiyatı">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <textarea class="form-control" name="description" id="description" cols="50"
                        rows="10">{{old('full_name',$entry->description)}}</textarea>
                </div>
            </div>

        </div>
</form>
@endsection
