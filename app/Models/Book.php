<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
protected $table = 'orders';
     protected $fillable = [
        'person', 'date','time','firstname','lastname','phone','countryCode',
        'email','occasion','comments','promoCode','source','is_seen','promo'
    ];

}
