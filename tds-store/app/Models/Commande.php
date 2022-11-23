<?php

namespace App\Models;

use App\Models\Livraison;
use App\Models\ProduitNonLivrer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['adresse_client_id', 'adresse_livraison_id', 'user_id', 'invoice_id', 'status', 'tva', 'promotion', 'created_at', 'updated_at'];

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

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
