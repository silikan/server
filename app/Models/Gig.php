<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;


    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
}
