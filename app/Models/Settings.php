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

    //Hero Information

    public function heroDescription(): ?string
    {
        return Arr::get($this->data, 'hero_description'); //will return null or with the value
    }

    public function heroTitle(): ?string
    {
        return Arr::get($this->data, 'hero_title'); //will return null or with the value
    }


    public function uploadFolder()
    {
        return "settings";
    }

    public function deleteImage(string $column): void
    {
        // $imagePath = $this->imageUrl($column);
        $imageName = Arr::get($this->data, $column);
        if ($imageName !== null) {
            // $imageName = Arr::get($this->data, $column);
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

    //Contact Information

    public function address(): ?string
    {
        return Arr::get($this->data, 'address');
    }

    public function email(): ?string
    {
        return Arr::get($this->data, 'email');
    }

    public function phone(): ?string
    {
        return Arr::get($this->data, 'phone');
    }

    public function googleMapUrl(): ?string
    {
        return Arr::get($this->data, 'google_map_url');
    }

    public function imageUrl(string $column): ?string
    {
        $imageName = Arr::get($this->data, $column);
        return $imageName === null
            ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF&size=512"
            : Storage::url("{$this->uploadFolder()}/{$imageName}"); // $this->uploadFolder() . "/" . $imageName;
    }
}