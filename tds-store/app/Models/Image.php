<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Image extends Model
{
    use HasFactory;
    use sluggable;

    public function sluggable():array
    {
        return [
            'slug'=>[
                'source' => 'nom'
            ]
            ];
    }


    protected $fillable = [ 'nom', 'slug', 'path', 'produit_id', 'created_at', 'updated_at'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
