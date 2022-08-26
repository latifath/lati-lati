<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    use sluggable;

    public function sluggable():array
    {
        return [
            'slug'=>[
                'source' => 'nom'
            ]
            ];
    }

    protected $fillable = [ 'sous_categorie_id', 'nom', 'description', 'slug', 'quantite', 'prix', 'prix_achat', 'prix_vente_500000', 'prix_vente_1000000', 'prix_vente_5000000', 'prix_vente_10000000', 'prix_vente_10000000_+',  'created_at', 'updated_at' ];

    public function promotions()
    {
    return $this->hasMany(Promotion::class);
    }

    public function stocks()
    {
    return $this->hasMany(Stock::class);
    }

    public function sous_categorie()
    {
    return $this->belongsTo(SousCategorie::class);
    }

    public function panier_produits()
    {
    return $this->hasMany(PanierProduit::class);
    }

    public function commande_produits()
    {
    return $this->hasMany(CommandeProduit::class);
    }

    public function images()
    {
    return $this->hasMany(Image::class);
    }

    public function produit_non_livrers()
    {
    return $this->hasMany(CommandeProduit::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(User::class);
    }

    // public function isLiked()
    // {
    //     if(auth()->check()){
    //         return auth()->user()->favoris()->contains('id', $this->id);
    //     }
    // }
}

