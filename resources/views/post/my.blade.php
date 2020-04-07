@extends('layouts.app')

@section('content')

@if(Session::has('message'))
  <div class="alert container alert-warning">
    {{Session::get('message')}}
  </div>
  @endif

<div class="container w-100 d-flex flex-column justify-content-center align-items-center">
      @foreach($posts as $post)
      <div class="card d-flex flex-column justify-items-center align-items-center w-50 p-2 m-4">
        <p class="text-center font-weight-bold text-primary">{{$post->title}}</p>
        <p class="text-center text-success">{{$post->content}}</p>
        <p class="text-center text-success">{{$post->id}}</p>
        <a href="{{route('posts.show',['post'=>$post])}}" class="btn btn-primary"> Ver mas</a>
        <a href="{{route('posts.edit',['post'=>$post])}}" class="btn btn-success"> Editar</a>
        <form action="{{ route('posts.destroy',['post'=>$post])}}" method="post">
          @method('DELETE')
          @csrf
          <button class="btn btn-danger ml-2"> Delete Post</button>
        </form>
      </div>
      @endforeach
    </div>

@endsection