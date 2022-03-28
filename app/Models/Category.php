<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function gigs()
    {
        return $this->belongsToMany(Gig::class, 'category_gig');
    }

    public function requests()
    {
        return $this->belongsToMany(ClientRequest::class, 'category_request');
    }
}
