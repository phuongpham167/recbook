<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta-description')
    <title>@yield('title') - {{config('setting.system_sitename')}}</title>
    <link rel="stylesheet" href="{{ asset('common-css/bootstrap.min.css') }}">
    @yield('style')
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('js')
</body>
