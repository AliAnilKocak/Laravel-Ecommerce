<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',config('app.name'))</title>
</head>
<body>

@include('layouts.partials.navbar')
    <h1>@yield('content')</h1>
@include('layouts.partials.footer',['year'=>2019])


</body>
</html>
