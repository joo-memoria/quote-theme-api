<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'quotes';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'additional_info',
        'is_confirmation',
    ];

    protected $casts = [
        'is_confirmation' => 'boolean',
    ];
}
