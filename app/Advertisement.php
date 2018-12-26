<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    //
    protected $table = 'advertisements';

    protected $fillable = [
        'name',
        'file_path',
        'url',
        'is_used',
        'duration_left',
        'chosen_time',
    ];
}
