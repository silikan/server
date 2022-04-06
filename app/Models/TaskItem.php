<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    use HasFactory;

    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }
    public function requests()
    {
        return $this->hasMany(ClientRequest::class);
    }
}
