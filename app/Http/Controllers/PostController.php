<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      // $posts = Post::where('user_id', Auth::id())->latest()->paginate(15);
      $posts = Post::with('user')->latest()->paginate(15);
      return view('posts.index', [
         'posts' => PostResource::collection($posts)
      ]);
   }

   public function index2()
   {
      return view('welcome', [
         'posts' => Post::with('user')->latest()->paginate(10)
      ]);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('posts.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StorePostRequest $request)
   {
      $attributes = $request->validated();

      $attributes['user_id'] = Auth::id();

      $image = $attributes['imageUrl'] ?? null;

      if ($image) {
         $path = $image->store('posts/' . Str::random(), 'public');
         $attributes['imageUrl'] = $path;
      }

      $post = Post::create($attributes);

      return redirect()->route('post.index')->with(['message' => $post->title . ' Created successfully']);
   }

   /**
    * Display the specified resource.
    */
   public function show(Post $post)
   {
      return view('posts.show', ['post' => $post]);
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Post $post)
   {
      //dd($post);

      if (Auth::user()->can('update', $post)) {
         return view('posts.edit', ['post' => $post]);
      } else {
         abort(403, 'This post belongs to another user you can\'t perform update action on it');
      }
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdatePostRequest $request, Post $post)
   {
      $attributes = $request->validated();

      $attributes['user_id'] = Auth::id();

      $tempPost = $post;

      $image = $attributes['imageUrl'] ?? null;

      if ($tempPost->imageUrl && $image) {
         Storage::disk('public')->deleteDirectory(dirname($tempPost->imageUrl));
      }

      if ($image) {
         $path = $image->store('posts/' . Str::random(), 'public');
         $attributes['imageUrl'] = $path;
      }

      $post->update($attributes);

      return redirect()->route('post.index')->with(['message' => $tempPost->title . ' Updated successfully']);
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Post $post)
   {

      if (Auth::user()->can('delete', $post)) {
         if ($post->imageUrl) {
            Storage::disk('public')->deleteDirectory(dirname($post->imageUrl));
         }

         $post->delete();

         return redirect()->route('post.index')->with(['message' => $post->title . ' Deleted successfully']);
      } else {
         abort(403, 'This post belongs to another user you can\'t perform delete action on it');
      }
   }
}
