<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Comment;
use Validator;
use App\Post;
use App\Comment as Comments;
use App\Block;

class DashboardController extends Controller
{
  /**
   * display short data and post list
   * @return mixed
   */
  public function index()
  {
    $data['posts']              = Post::where('1', '1')->orderBy('id', 'Desc')->get();
    $data['comments']           = Comments::where('1', '1')->orderBy('id', 'Desc')->limit(5)->get();
    $data['post_count']         = Post::count();
    $data['comment_count']      = Comments::count();
    $data['blocked_user_count'] = Block::count();

    $mostCommentedPost =
      Post::with('comments')
        ->get()
        ->sortBy(function($post) {
          return $post->comments->count();
        }, SORT_REGULAR, true)
        ->first();

    $latestComment =
      Comments::where('1', '1')
        ->orderBy('id', 'DESC')
        ->limit(1)
        ->get()
        ->first();

    $data['most_commented_post'] =
      [
        'id'          => $mostCommentedPost->id,
        'title'       => $mostCommentedPost->title
      ];

    $data['latest_comment'] =
      [
        'created_at'  => $latestComment->created_at,
        'post_id'     => $latestComment->post_id,
        'comment'     => mb_substr($latestComment->comment, 0, 10).'...'
      ];

    return view('dashboard.index', $data);
  }

  /**
   * get comment list for post id
   * @param Request $request
   * @return array
   */
  public function commentsForPost(Request $request) {
    $comments = Comments::where('post_id', $request->post_id)->get();
    return ['comments' => $comments];
  }
}
