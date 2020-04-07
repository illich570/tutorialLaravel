<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\PostFormRequest;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $posts = Post::paginate(10);
      return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->user()->id;

        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      $counter = 0;
      if(Redis::exists('post:views:'.$post->id)){
        Redis::incr('post:views:'.$post->id);
        $counter = Redis::get('post:views:'.$post->id);
      }else{
        Redis::set('post:views:'.$post->id, 0);
      }
        return view('post',compact('post',"counter"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $this->authorize('update',$post);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()
        ->route('posts.edit',['post'=>$post])
        ->with('message','Post Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

      if(Gate::denies('delete-post',$post)){
        redirect()->back();
      }

        $this->authorize('delete',$post);
        $post->delete();

        return redirect()->route('posts.index');
    }

    public function myPosts(){
      $posts = Auth::user()->posts;
      
      return view('post.my',compact('posts'));
    }
}
