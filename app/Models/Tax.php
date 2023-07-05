<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'value'
    ];

    public function products(){
        //relacion de uno a muchos con productos
        return $this->hasMany(Product::class);
    }


}
