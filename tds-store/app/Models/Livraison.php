<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'adresse_client_id', 'created_at', 'updated_at'];

    public function adresse_client()
    {
        return $this->belongsTo(AdresseClient::class);
    }
}
