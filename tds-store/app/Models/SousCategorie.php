<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SousCategorie extends Model
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

    protected $fillable = ['categorie_id', 'nom', 'slug', 'created_at', 'updated_at'];

    public function categorie()
    {
    return $this->belongsTo(Categorie::class);
    }

    public function produits()
    {
    return $this->hasMany(Produit::class);
    }
}
