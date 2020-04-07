@extends('layouts.app')

@section('content')

  @if(Session::has('message'))
  <div class="alert container alert-success">
    {{Session::get('message')}}
  </div>
  @endif

  @if($errors->any())
  <div class="container alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="post" action="{{route('posts.update', $post)}}">
  @method('PUT')
  @csrf
  <div class="row justify-content-center">
    <div class="col-sm-7">
      <div class="form-group">
      <label for="title">Titulo</label>
      <input type="text" class="form-control" value="{{ $post->title }}" name="title" id="title" placeholder="Titulo">
      </div>

      <div class="form-group">
      <label for="content">Contenido</label>
      <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
      </div>
    </div>

    <div class="col-sm-7 text-center">
    <button type="submit">Send</button>
    </div>
  </div>
</form>
@endsection
