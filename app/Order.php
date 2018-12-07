<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';

    //set array type to product_ids and quantities
    protected $casts = [
        'product_ids' => 'array',
        'quantities' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'is_check',
        'total_price',
        'product_ids',
        'quantities',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
