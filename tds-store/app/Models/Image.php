<?php

namespace App\Models;

use App\Models\Publicite;
use App\Models\Partenaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;


    protected $fillable = ['filename', 'mimetype', 'created_at', 'updated_at'];

    public function img_produits()
    {
        return $this->hasMany(Produit::class);
    }
    public function partenaires()
    {
        return $this->hasMany(Partenaire::class);
    }
    public function publicites()
    {
        return $this->hasMany(Publicite::class);
    }

    public function produits()
    {

    return $this->belongsToMany(Produit::class);

    }
}
