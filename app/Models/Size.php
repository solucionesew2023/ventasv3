<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

            ];

    public function products(){

   //relacion muchos a muchos productos colores tallas
  return $this->belongsToMany(Product::class)->withPivot('quantity','purchase_price','profit_percentage');


            }
}
