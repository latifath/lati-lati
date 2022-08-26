<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [ 'commande_id', 'reference', 'montant', 'type_paiement', 'created_at', 'updated_at'];

    public function commande()
    {
    return $this->belongsTo(Commande::class);
    }
}
