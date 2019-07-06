@extends('manage.layouts.master')
@section('title','Ana Sayfa')
@section('content')
<h1 class="page-header">Kullanıcı Yönetimi</h1>
<h1 class="sub-header">
    <div class="btn-group pull-right" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary">Print</button>
        <button type="button" class="btn btn-primary">Export</button>
    </div>
    Table
</h1>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>

                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Aktiflik</th>
                <th>Adminlik</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @foreach ($list as $item)
            <tr>

                <td>{{$item->full_name}}</td>
                <td>{{$item->email}}</td>
                <td>
                @if ($item->is_active)
                <span class="label label-success">Aktif</span>
                @else
                <span class="label label-warning">Pasif</span>
                @endif
               </td>
               <td>
                    @if ($item->is_admin)
                    <span class="label label-danger">Admin</span>
                    @else
                    <span class="label label-primary">Müşteri</span>
                    @endif
                   </td>
                <td>{{$item->created_at}}</td>

                <td style="width: 100px">
                    <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Tooltip on top" onclick="return confirm('Are you sure?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
