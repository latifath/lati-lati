<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    public $discount;

    use HasFactory;
    protected $fillable = ['code', 'type', 'valeur', 'status', 'created_at', 'updated_at'];


    public function discount($soustotal){

        if(session()->has('coupon')['type'] == 'fixed') {
            $this->discount = session()->get('coupon')['value'];
        }
        else{
            $this->discount = (Panier::instance('panier')->soustotal() * session()->get('coupon')['value'])/100;

        }

    }

    public function produit()
    {

    return $this->belongsTo(Produit::class);

    }

    public function commandes()
    {
    return $this->hasMany(Commande::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

}
