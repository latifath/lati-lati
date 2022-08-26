<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Categorie extends Model
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

    protected $fillable = [ 'nom', 'slug', 'created_at', 'updated_at'];

    public function sous_categories()
    {
    return $this->hasMany(SousCategorie::class);
    }

    // public function getRouteKeyName() {
    //     return $this->getKeyName();
    // }
}

