<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
        'level_id',
        'file_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function shoppingcarts()
    {
        return $this->hasMany(Shoppingcart::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
