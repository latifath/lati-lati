<?php

namespace App\Models;

use App\Models\Livraison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expedition extends Model
{
    use HasFactory;

    protected $fillable = ['ville', 'montant', 'created_at', 'updated_at'];

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}
