<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
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

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }



    //belongs to many categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_gig');
    }

    //gig hasmany images
    public function images()
    {
        return $this->hasMany(GigImages::class);
    }
}
