<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdresseLivraison extends Model
{
    use HasFactory;
    protected $fillable = [ 'nom', 'prenom', 'email', 'telephone', 'pays', 'rue', 'ville', 'code_postal', 'created_at', 'updated_at'];

    public function commandes()
    {
    return $this->hasMany(Commande::class);
    }

}
