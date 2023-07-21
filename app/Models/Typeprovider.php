<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeprovider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

            ];

            public function providers(){
                //relacion uno a muchos con prvedores
                return $this->hasMany(Provider::class);
            }

}
