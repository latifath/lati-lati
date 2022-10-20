<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publicite extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'message', 'image_id', 'created_at', 'updated_at'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
