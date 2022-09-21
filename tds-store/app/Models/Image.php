<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Image extends Model
{
    use HasFactory;


    protected $fillable = ['filename', 'created_at', 'updated_at'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);

    }

    public function produits()
    {

    return $this->belongsToMany(Produit::class);

    }
}
