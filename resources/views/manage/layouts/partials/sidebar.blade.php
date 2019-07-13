<div class="list-group">
    <a href="{{route('manage.homepage')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Giriş</a>
    <a href="{{route('manage.product')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Products
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
    <a href="{{route('manage.category')}}" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar">
        <span class="fa fa-fw fa-dashboard"></span> Categories<span class="caret arrow"></span></a>
  <div class="list-group collapse" id="submenu1">
    <a href="#" class="list-group-item">Category</a>
    <a href="#" class="list-group-item">Category</a>
  </div>
    <a href="{{route('manage.user')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Kullanıcılar
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
    <a href="{{route('manage.order')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Siparişler
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Orders
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
</div>
