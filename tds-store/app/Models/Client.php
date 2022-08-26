<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [ 'nom', 'prenom', 'email', 'telephone', 'pays', 'rue', 'ville', 'code_postal', 'nom_entreprise', 'user_id', 'created_at', 'updated_at'];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
