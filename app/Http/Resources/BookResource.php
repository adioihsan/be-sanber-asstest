<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'description'=>$this->description,
            'image_url'=>$this->image_url,
            'release_year'=>$this->release_year,
            'price'=>$this->price,
            'total_page'=>$this->total_page,
            'thickness'=>$this->thickness,
            'category_id'=>$this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
