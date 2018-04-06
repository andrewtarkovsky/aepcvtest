<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePost($request);
        $post           = new Post;
        $post->title    = $request->title;
        $post->text     = $request->text;
        $post->save();
        return redirect()->action('PostController@show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post           = Post::findOrFail($id);
        $this->validatePost($request);
        $post->title    = $request->title;
        $post->text     = $request->text;
        $post->save();
        return redirect()->action('PostController@show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->forceDelete();
    }

    /**
     * api - display requested post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apiGetPost(Request $request)
    {
        $post = Post::findOrFail($request->id);

        return $post;
    }

    /**
     * api - create new post
     * @param Request $request
     * @return Post
     */
    public function apiCreatePost(Request $request) {
        $this->validatePost($request);
        $post           = new Post;
        $post->title    = $request->title;
        $post->text     = $request->text;
        $post->save();
        return $post;
    }

    /**
     * api - update post
     * @param Request $request
     * @return mixed
     */
    public function apiUpdatePost(Request $request) {
        $this->validatePost($request);

        $post           = Post::findOrFail($request->id);
        $post->title    = $request->title;
        $post->text     = $request->text;
        $post->save();
        return $post;
    }

    /**
     * validation rules for post create/update
     * @param $request
     */
    protected function validatePost($request) {
        Validator::make($request->toArray(), [
          'title'   => ['required', Rule::unique('posts')->ignore($request->id)],
          'text'    => 'required|max:255'
        ]);
    }
}
