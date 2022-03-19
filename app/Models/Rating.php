<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function gig()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
