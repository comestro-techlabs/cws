<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cat_title' => $this->cat_title,
            'cat_slug' => $this->cat_slug,
            'cat_description' => $this->cat_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}