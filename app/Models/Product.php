<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_id',
        'tax_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'stock_min',
        'status'
            ];

    public function subcategory(){
        //relacion inversa con subcategorias
        return $this->belongsTo(Subcategory::class);
    }
    public function tax(){
        //relacion inversa con impuestos
        return $this->belongsTo(Tax::class);
    }
    public function brand(){
        //relacion inversa con marcas
        return $this->belongsTo(Brand::class);
    }



    public function colors(){
        //relacion muchos a muchos productos colores
        return $this->belongsToMany(Color::class)->withPivot('quantity','purchase_price','profit_percentage');
    }

    public function sizes(){
        //relacion muchos a muchos productos colores tallas
        return $this->belongsToMany(Size::class)->withPivot('quantity','purchase_price','profit_percentage');

    }
    


    //Relacion uno a muchos entre productos e imagenes
  public function images(){
    return $this->hasMany(Image::class);
}
public function productQuantity(): HasOne
    {
        return $this->hasOne(ProductQuantity::class);
    }

}
