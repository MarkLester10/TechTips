<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->when($this->slug, $this->slug),
            // This will be available when it is called or plucked or when it is present in the model
            'created_at_for_human' => $this->when($this->created_at, function () {
                return $this->created_at->diffForHumans();
            }),
            'modified_at_for_human' => $this->when($this->updated_at, function () {
                return $this->updated_at->diffForHumans();
            }),
        ];
    }
}