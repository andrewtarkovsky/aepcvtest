<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Block;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postId)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $block = Block::where('email', $request->email)->first();
        if($block) {
            return redirect()->action('PostController@show', $post);
        }

        $comment = new Comment;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $post->comments()->save($comment);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Block the person by email
     * @param $email
     * @return \Illuminate\Http\Response
     */
    public function block(Request $request) {
        $email = $request->email;
        $block = Block::where('email', $email)->first();

        if(!$block) {
            $block = new Block;
            $block->email = $email;
            $block->save();
        }

        $comments = Comment::where('email', $email);
        $comments->forceDelete();

        $post = Post::findOrFail($request->post_id);
        return redirect()->action('PostController@show', $post);
    }
}
