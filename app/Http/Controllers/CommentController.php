<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      //
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create(Post $post)
   {


      $comments = Comment::with('post')->where('post_id', $post->id)->latest()->paginate(15);

      return view('comments.create', [
         'post' => $post,
         'comments' => $comments
      ]);
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreCommentRequest $request)
   {
      $attributes = $request->validated();

      $attributes['post_id'] = $request['postId'];

      $attributes['user_id'] = Auth::id();

      Comment::create($attributes);

      $post = Post::findOrFail($request['postId']);

      return redirect()->route('comment.create', $post)->with(['message' => 'Comment Created successfully']);
   }

   /**
    * Display the specified resource.
    */
   public function show(Comment $comment)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Comment $comment, Post $post)
   {
      if (Auth::user()->can('update', $comment)) {
         return view('comments.edit', [
            'post' => $post,
            'comment' => $comment
         ]);
      } else {
         return redirect()->route('comment.create', $comment->post_id)->with(['message' => 'This comment belongs to another user you can\'t perform update action on it']);
      }
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdateCommentRequest $request, Comment $comment)
   {
      $attributes = $request->validated();

      $comment->update($attributes);

      return redirect()->route('comment.create', $comment->post_id)->with(['message' => 'Comment Updated successfully']);
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Comment $comment)
   {
      if (Auth::user()->can('delete', $comment)) {
         $comment->delete();
         return redirect()->route('comment.create', $comment->post_id);
      } else {
         return redirect()->route('comment.create', $comment->post_id)->with(['message' => 'This comment belongs to another user you can\'t perform delete action on it']);
      }
   }
}
