<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = [ 'invoice_id', 'user_id', 'description', 'price', 'quantity', 'amount', 'created_at', 'updated_at'];

    public function invoice()
    {
    return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
