<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class , 'category_request');
    }

    public function images()
    {
        return $this->hasMany(RequestImages::class);
    }
}
