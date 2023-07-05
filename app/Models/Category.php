<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'slug'
            ];

  //Relacion uno a muchos entre categorias y subcategorias
  public function subcategories(){
    return $this->hasMany(Subcategory::class);
}





}
