<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    use HasFactory;

    public function gigs()
    {
        return $this->belongsToMany(Gig::class);
    }
    public function clientRequests()
    {
        return $this->belongsToMany(ClientRequest::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}



