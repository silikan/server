<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }
    public function requests()
    {
        return $this->hasMany(ClientRequest::class);
    }

}
