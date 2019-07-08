@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Kategori Yönetimi</h1>
@include('layouts.partials.alert')
<h3 class="sub-header">Kategorilar</h3>
<div class="well">
    <div class="btn-group pull-right" role="group" aria-label="Basic example">
        <a href="{{route('manage.category.create')}}" class="btn btn-link"> + Yeni Kategori</a>
    </div>
    <form method="POST" class="form-inline" action="{{route('manage.category')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="search_word">Ara</label>
            <input placeholder="Kategori ara" value="{{old('search_word')}}" type="text"
                class="form-control form-control-sm" name="search_word" id="search_word">
        </div>
        <button class="btn btn-info" type="submit">Ara</button>
        <a class="btn btn-primary" href="{{route('manage.category')}}">Temizle</a>

    </form>
</div>


<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>

                <th>Slug</th>
                <th>Adı</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
            <tr>

                <td>{{$item->slug}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->created_at}}</td>

                <td style="width: 100px">
                    <a href="{{route('manage.category.edit',$item->id)}}" class="btn btn-xs btn-success"
                        data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('manage.category.delete',$item->id)}}" class="btn btn-xs btn-danger"
                        data-toggle="tooltip" data-placement="top" title="Tooltip on top"
                        onclick="return confirm('Are you sure?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$list->appends('search_word',old('search_word'))->links()}}
</div>
@endsection
