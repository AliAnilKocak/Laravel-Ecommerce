<h1>{{config('app.name')}}</h1>
<p>Merhaba {{$user->full_name}},  Kaydınız başarılı bir şekilde yapıldı.</p>
<p>Kaydınızı tamamlamak için bağlantıya tıklayın <a
        href="{{config('app.url')}}/user/activation/{{$user->activation_key}}"></a></p>
