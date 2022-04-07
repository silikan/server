<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    use HasFactory;
    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class , 'cart_item_client_request' );
    }

    public function taskItems()
    {
        return $this->belongsToMany(TaskItem::class , 'task_item_client_request' );
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
