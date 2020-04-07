<html>
  <head>
    <title>estas en @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
    <h1>Hola</h1>
    <div class="container">
      @yield('content')
    </div>
  </body>
</html>