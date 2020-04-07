@extends('layouts.app')

  @section('content')
  <div class="container w-100 d-flex flex-column justify-content-center align-items-center">
      @foreach($posts as $post)
      @can('view',$post)
      <div class="card d-flex flex-column justify-items-center align-items-center w-50 p-2 m-4">
        <p class="text-center font-weight-bold text-primary">{{$post->title}}</p>
        <p class="text-center text-success">{{$post->content}}</p>
        <p class="text-center text-success">{{$post->id}}</p>
        <a href="{{route('posts.show',['post'=>$post])}}" class="btn btn-primary"> Ver mas</a>
      </div>
      @endcan
      @endforeach

      {{$posts->links() }}
    </div>
  @endsection
