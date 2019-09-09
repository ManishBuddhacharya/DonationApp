<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png')}}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{asset('css/backend.css')}}" type="text/css"/>
      <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/backend.js')}}"></script>
  </head>
  <body>
      @yield('body')
      <script type="text/javascript" src="{{asset('js/perfect-scrollbar.jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
      });
    </script>
  </body>
</html>