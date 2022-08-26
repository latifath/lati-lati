<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = [ 'created_at', 'updated_at'];


    public function panier_produits()
    {
    return $this->hasMany(PanierProduit::class);
    }
    public function getTotalQuantity()
    {
        return 3 ;
    }
    public function getTotal()
    {
        return 3 ;
    }
}
