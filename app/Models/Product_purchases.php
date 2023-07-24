<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_purchases extends Model
{
    use HasFactory;
    protected $fillable=[
            'purchase_id',
            'product_id',
            'product_price',
            'product_amount',
            'iva',
            'subtotal',
            'color',
            'size'
                        ];

}
