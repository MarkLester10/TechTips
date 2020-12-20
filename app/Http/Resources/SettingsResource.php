<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'hero_description' => $this->heroDescription(),
            'hero_image_url' => $this->imageUrl('hero_image'),
            'hero_title' => $this->heroTitle(),
            'about_description' => $this->aboutDescription(),
            'about_image_url' => $this->imageUrl('about_image'),
            'about_title' => $this->aboutTitle(),
            'contact_image_url' => $this->imageUrl('contact_image'),
            'address' => $this->address(),
            'phone' => $this->phone(),
            'email' => $this->email(),
            'google_map_url' => $this->googleMapUrl(),
        ];
    }
}