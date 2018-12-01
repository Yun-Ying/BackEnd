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
}
