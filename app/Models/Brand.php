<?php

namespace App\Models;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable=[
        'name'
    ];

    public function products(){
        //relacion uno a muchos con productos
        return $this->hasMany(Product::class);
    }

    public function categories(): BelongsToMany{
        //relacion muchos a muchos con cetegory
        return $this->belongsToMany(Category::class);
    }

}
