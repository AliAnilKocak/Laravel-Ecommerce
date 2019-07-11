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
                        rows="10">{{old('description',$entry->description)}}</textarea>
                </div>
            </div>

            <div class="checkbox">
                <label>

                    <input name="show_slider" value="1"
                        {{old('show_slider',$entry->detail->show_slider) ? 'checked' : '' }} type="checkbox"> Slider
                </label>
            </div>

            <div class="checkbox">
                <label>

                    <input name="show_day_opportunity" value="1"
                        {{old('show_day_opportunity',$entry->detail->show_day_opportunity) ? 'checked' : '' }}
                        type="checkbox"> Günün fırsatı
                </label>
            </div>

            <div class="checkbox">
                <label>

                    <input name="show_featured" value="1"
                        {{old('show_featured',$entry->detail->show_featured) ? 'checked' : '' }} type="checkbox"> Yeni
                    Ürün
                </label>
            </div>

            <div class="checkbox">
                <label>

                    <input name="show_bestselling" value="1"
                        {{old('show_bestselling',$entry->detail->show_bestselling) ? 'checked' : '' }} type="checkbox">
                    Çok
                    Satılan
                </label>
            </div>
            <div class="checkbox">
                <label>

                    <input name="show_reduced" value="1"
                        {{old('show_reduced',$entry->detail->show_reduced) ? 'checked' : '' }} type="checkbox">
                    İndirimde
                </label>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <select multiple name="categories[]" class="form-control" id="categories">
                        @foreach ($categories as $category)
                        <option
                            {{collect(old('categories',$product_categories))->contains($category->id) ? 'selected' : ''}}
                            value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
</form>
@endsection



@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection

@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
    $(function(){
        $('#categories').select2({
            placeholder: 'Kategori seçiniz'
        });
    });
</script>
@endsection
