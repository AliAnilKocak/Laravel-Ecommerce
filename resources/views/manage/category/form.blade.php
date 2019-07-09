@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Kategori Yönetimi</h1>
<form method="post" action="{{route('manage.category.save',@$entry->id)}}">
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
                <div class="col-sm-4">
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="">Ana Kategori</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <input type="name" name="name" class="form-control" id="name" value="{{old('full_name',$entry->name)}}"
                        placeholder="Kategori ismi">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <input type="hidden" name="original_slug" id="original_slug" value="{{old('slug',$entry->slug)}}">
                    <input type="text" name="slug" class="form-control" id="slug" value="{{old('slug',$entry->slug)}}"
                        placeholder="Slug">
                </div>
            </div>
        </div>
</form>
@endsection
