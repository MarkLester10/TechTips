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
        return $this->imageUrl('hero_image');
    }

    public function uploadFolder()
    {
        return "public/settings";
    }

    public function deleteImage()
    {
        $imageName = $this->imageUrl('hero_image');
        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }


    //About Information

    public function aboutDescription(): ?string
    {
        return Arr::get($this->data, 'about_description'); //will return null or with the value
    }

    public function aboutTitle(): ?string
    {
        return Arr::get($this->data, 'about_title'); //will return null or with the value
    }


    public function aboutImageUrl(): ?string
    {
        return $this->imageUrl('about_image');
    }


    public function imageUrl(string $column): ?string
    {
        $imageName = Arr::get($this->data, $column);
        return $imageName === null
            ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF&size=512"
            : Storage::url("{$this->uploadFolder()}/{$imageName}"); // $this->uploadFolder() . "/" . $imageName;
    }
}