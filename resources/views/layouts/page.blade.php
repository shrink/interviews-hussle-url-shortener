<!doctype html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ mix('/css/app.css', 'assets') }}">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600|Roboto+Mono:400,700" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{{ config('app.name') }}</title>
  </head>
  <body class="roboto f6 ph4 ph5-ns pv4 mw6 black-80 mb4">
    @yield('body')
  </body>
</html>
