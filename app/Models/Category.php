<?php
namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

public function brands(): BelongsToMany{
   //relacion muchos a muchos con brands
    return $this->belongsToMany(Brand::class);
}






}
