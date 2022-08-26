<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['quantite', 'prix_unitaire', 'montant', 'nom_produit',  'produit_id', 'created_at', 'updated_at', ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
