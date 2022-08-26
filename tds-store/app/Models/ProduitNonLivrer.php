<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitNonLivrer extends Model
{
    use HasFactory;

    protected $fillable = [ 'commande_id', 'produit_id', 'quantite', 'status', 'created_at', 'updated_at' ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function produit()
    {
    return $this->belongsTo(Produit::class);
    }


}
