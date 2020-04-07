
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
    @include('_nav')

    <div class="container d-flex flex-column align-items-center justify-content-center">
      <h1>{{$post->title}}</h1>
      <div class="text-center">
        @include('post.child')
      </div>
      <div class="card-header d-flex">
        <p> Views {{$counter}}</p>
      </div>
    </div>

  </body>
</html>