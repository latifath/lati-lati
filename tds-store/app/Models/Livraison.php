<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'montant', 'status', 'invoice_id', 'created_at', 'updated_at'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
