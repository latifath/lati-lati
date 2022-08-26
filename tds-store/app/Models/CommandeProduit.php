<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeProduit extends Model
{
    use HasFactory;

    protected $fillable = [ 'commande_id', 'produit_id', 'quantite', 'prix', 'created_at', 'updated_at'];

    public function produit()
    {
    return $this->belongsTo(Produit::class);
    }

    public function commande()
    {
    return $this->belongsTo(Commande::class);
    }
}
