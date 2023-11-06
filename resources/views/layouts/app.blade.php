<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @vite(['resources/sass/layout.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="container mb-5">
        <header class="blog-header py-3 fixed-top bg-white">
          <div class="row flex-nowrap justify-content-between align-items-center">
            
            <div class="col-12 text-center">
              <a class="blog-header-logo text-dark" href="{{ route( 'web.dashboard' ) }}">Posts</a>
            </div>
            
          </div>
        </header>
      </div>
      
      <main class="container main-container">
        @yield('content')
      </main>
     
</body>
</html>
