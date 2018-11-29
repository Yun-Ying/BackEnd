<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    //
    protected $table = 'shoppingcarts';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
}
