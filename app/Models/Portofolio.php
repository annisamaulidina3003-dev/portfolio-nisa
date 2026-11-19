<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function getImageDataUrlAttribute(): ?string
    {
        if (is_null($this->image)) {
            return null;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $this->image);
        finfo_close($finfo);

        return 'data:'.$mime.';base64,'.base64_encode($this->image);
    }
}
