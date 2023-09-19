@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name', 'Laravel') }}</title>
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
           
                <a class="navbar-brand" href="{{ url('/') }}">
                </a>
                
                <div class="row">
                    
              
                <p align="left"><div class="panel-heading"><span style="color: green">You are logged in as Admin!</div></span>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                </div>
                </p>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
  
                    </ul>
  
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                   
                    <li><a class="nav-link"  href="{{ route('users.index') }}">Manage Users</a></li>

                    <<li><a class="nav-link"  href="{{ route('laporans.index') }}">Manage Laporan User</a></li>
                    

          </ul>
       </div>
    </div>
  </div>
</div>
</div>
@endsection