<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Gallery extends Model
{
    protected $fillable = [
        'house_id', 'image_name', 'extension', 'is_featured'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function showImages($path)
    {
        $image_name = $this->image_name . '.' . $this->extension;

        if (File::exists(storage_path('app/public/photos/thumbnails/') . $image_name)) {
            return $path . '/' . $image_name;
        }

        return  asset("img/default-house.jpeg");
    }
}
