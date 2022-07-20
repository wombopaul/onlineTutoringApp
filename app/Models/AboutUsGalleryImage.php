<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsGalleryImage extends Model
{
    use HasFactory;

    public function getImagePathAttribute()
    {
        if ($this->image)
        {
            if (\File::exists($this->image))
            {
                return $this->image;

            } else {
                return 'uploads/default/no-image-found.png';
            }
        } else {
            return 'uploads/default/no-image-found.png';
        }
    }
}
