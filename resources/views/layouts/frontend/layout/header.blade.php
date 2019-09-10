<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png')}}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" id="projectCSS" type="text/css" href="{{ asset('css/all.css')}}"/>
    <script src="{{ asset('js/all.js')}}" type="text/javascript"></script>
    <style type="text/css">
        p{
            font-family: open sans, sans-serif;
        }
        ul li, ul li a, ol li, ol li a {
            font-family: open sans, sans-serif;
        }
    </style>
  </head>
<body style="font-family: open sans, sans-serif;">
<div class="theme-layout">
