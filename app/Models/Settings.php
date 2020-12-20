<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Strong;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    public function heroDescription(): ?string
    {
        return Arr::get($this->data, 'hero_description'); //will return null or with the value
    }

    public function heroTitle(): ?string
    {
        return Arr::get($this->data, 'hero_title'); //will return null or with the value
    }


    public function heroImageUrl(): ?string
    {
        $imageName = Arr::get($this->data, 'hero_img');

        return $imageName === null
            ? 'https://ui-avatars.com/api/?name=Hero_Image&color=7F9CF5&background=EBF4FF'
            : Storage::url("{$this->uploadFolder()}/{$imageName}"); // $this->uploadFolder() . "/" . $imageName;

    }

    public function uploadFolder()
    {
        return "public/settings";
    }

    public function deleteImage()
    {
        $imageName = Arr::get($this->data, 'hero_img');
        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
}