@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Kullanıcı Yönetimi</h1>

<form method="post" action="{{route('manage.user.save',@$entry->id)}}">
    <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{@$entry->id>0 ? "Güncelle" : "Kaydet" }}
        </button>
    </div>
    <h1 class="sub-header">{{@$entry->id>0 ? "Güncelleme" : "Yeni Kayıt" }} formu </h1>
    {{ csrf_field() }}
    @include('layouts.partials.alert')
    @include('layouts.partials.errors')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="full_name">Ad Soyad</label>
                <input type="text" name="full_name" class="form-control" value="{{old('full_name',$entry->full_name)}}" id="full_name"
                    placeholder="Ad Soyad">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" value="{{old('email',$entry->email)}}" id="email"
                    placeholder="Email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password"  class="form-control" id="password" placeholder="Password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="adress">Address</label>
                <input type="text" class="form-control" id="adress" name="adress" value="{{old('adress',$entry->detail->adress)}}"
                    placeholder="Address">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="telephone">Telefon</label>
                <input type="text" class="form-control" id="telephone" name="tel_number"
                    value="{{old('tel_number',$entry->detail->tel_number)}}" placeholder="Telephone">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="mobilephone">Cep telefonu</label>
                <input type="text" class="form-control" id="mobilephone" value="{{old('number',$entry->detail->number)}}"
                    name="number" placeholder="Cep Telephone">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile">
        <p class="help-block">Example block-level help text here.</p>
    </div>
    <div class="checkbox">
        <label>
            <input type="hidden" name="is_active" value="0" id="">
            <input name="is_active" value="1" {{old('is_active',$entry->is_active) ? 'checked' : '' }} type="checkbox"> Aktif mi
        </label>
    </div>
    <div class="checkbox">
        <label>
                <input type="hidden" name="is_admin" value="0" id="">

            <input name="is_admin" value="1" {{old('is_admin',$entry->is_admin) ? 'checked' : '' }} type="checkbox"> Admin mi
        </label>
    </div>
</form>
@endsection
