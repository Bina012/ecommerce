<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkouts';

    protected $fillable = ['customer_id','name','company','contact','email',	'country',	'address',	'subtotal',	'discount',	'total',	'payment_type',	'payment_code',	'status','checkout_code'	];

}
