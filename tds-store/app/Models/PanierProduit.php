<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierProduit extends Model
{
    use HasFactory;

    protected $fillable = [ 'panier_id', 'produit_id', 'quantite', 'created_at', 'updated_at'];

    public function panier()
    {
    return $this->belongsTo(Panier::class);
    }
    
    public function produit()
    {
    return $this->belongsTo(Produit::class);
    }
}
