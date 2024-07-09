<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
   /**
    * Determine whether the user can view any models.
    */
   public function viewAny(User $user): bool
   {
      return true;
   }

   /**
    * Determine whether the user can view the model.
    */
   public function view(User $user, Comment $comment): bool
   {
      return true;
   }

   /**
    * Determine whether the user can create models.
    */
   public function create(User $user): bool
   {
      return true;
   }

   /**
    * Determine whether the user can update the model.
    */
   public function update(User $user, Comment $comment): bool
   {
      //dd($user->id, '   ', $comment->user_id);
      if ($user->id === $comment->user_id) {
         return true;
      }

      return false;
   }

   /**
    * Determine whether the user can delete the model.
    */
   public function delete(User $user, Comment $comment): bool
   {
      //to perform delete there is a few conditions to be authorized

      // 1. if the comment belongs to the logged user
      // 2. if the comment belongs to the logged user post

      if ($user->id === $comment->user_id) {

         return true;
      } else if ($user->id === $comment->post->user_id) {

         return true;
      }

      return false;
   }

   /**
    * Determine whether the user can restore the model.
    */
   public function restore(User $user, Comment $comment): bool
   {
      return true;
   }

   /**
    * Determine whether the user can permanently delete the model.
    */
   public function forceDelete(User $user, Comment $comment): bool
   {
      return true;
   }
}
