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
        return $this->belongsToMany(TaskItem::class , 'client_request_task_item' , 'client_request_id' , 'task_item_id');
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
