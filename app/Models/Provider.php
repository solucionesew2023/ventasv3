<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable=[
        'city_id',
        'name',
        'nit',
        'email',
        'phone',
        'address',
        'name_contact',
    ];
//Relacion uno a muchos con shopping
    public function purchase(){

        return $this->hasMany(Purchase::class);
    }
    //relacion inversa con ciudades
    public function city(){
        return $this->belongsTo(City::class);
    }
}
