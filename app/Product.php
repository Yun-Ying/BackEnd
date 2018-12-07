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
        'category',
        'level'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Level()
    {
        return $this->belongsTo(Level::class);
    }
    public function shoppingcarts()
    {
        return $this->hasMany(Shoppingcart::class);
    }
}
