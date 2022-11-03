<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    use HasFactory;

    protected $fillable = ['ville', 'montant', 'created_at', 'updated_at'];

    public function livraisons()
    {
        return $this->hasMany(Paiement::class);
    }
}
