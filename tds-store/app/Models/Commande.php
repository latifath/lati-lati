<?php

namespace App\Models;

use App\Models\ProduitNonLivrer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['adresse_client_id', 'adresse_livraison_id', 'status', 'user_id', 'tva', 'promotion', 'created_at', 'updated_at'];

    public function paiements()
    {
    return $this->hasMany(Paiement::class);
    }

    public function adresse_client()
    {
    return $this->belongsTo(AdresseClient::class);
    }

    public function commande_produits()
    {
    return $this->hasMany(CommandeProduit::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function adresse_livraison()
    {
    return $this->belongsTo(AdresseLivraison::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function produit_non_livrer()
    {
        return $this->hasMany(ProduitNonLivrer::class);
    }
}
