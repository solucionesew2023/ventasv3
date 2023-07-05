<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

            ];

            public function products(){
       //relacion muchos a muchos colores  productos
                return $this->belongsToMany(Product::class)->withPivot('quantity','purchase_price','profit_percentage');

            }
}
