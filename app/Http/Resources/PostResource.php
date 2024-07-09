<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'imageUrl' => ($this->imageUrl && !(str_starts_with($this->imageUrl, 'http'))) ? Storage::url($this->imageUrl) : $this->imageUrl,
            'user_id' => $this->user_id,
        ];
    }
}
