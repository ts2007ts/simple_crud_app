<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
   use HasFactory;

   protected $fillable = [
      'post_id',
      'user_id',
      'body'
   ];

   /**
    * Get the post that owns the Comment
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function post(): BelongsTo
   {
      return $this->belongsTo(Post::class);
   }

   /**
    * Get the user that owns the Comment
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class);
   }
}
