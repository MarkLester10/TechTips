<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function uploadFolder()
    {
        return "articles";
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault(); //if article has no category
    }

    public function deleteImage(string $column = "image"): void
    {
        $imageName = $this->{$column};
        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }


    public function imageUrl(string $column = "image"): ?string
    {
        $imageName = $this->{$column};
        return $imageName === null
            ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF&size=512"
            : Storage::url("{$this->uploadFolder()}/{$imageName}"); // $this->uploadFolder() . "/" . $imageName;
    }
}