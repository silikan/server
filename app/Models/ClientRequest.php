<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    use HasFactory;
    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

    public function taskItem()
    {
        return $this->belongsTo(TaskItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_request');
    }

    public function images()
    {
        return $this->hasMany(RequestImages::class);
    }
}
