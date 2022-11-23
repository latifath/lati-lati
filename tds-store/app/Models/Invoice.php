<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'date', 'date_paid', 'date_cancel', 'subtotal', 'total', 'payment_method', 'tva', 'reference', 'normalize', 'status', 'created_at', 'updated_at'];

    public function commandes()
    {
    return $this->hasMany(Commande::class);
    }

    public function invoice_items()
    {
    return $this->hasMany(InvoiceItem::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }


}
