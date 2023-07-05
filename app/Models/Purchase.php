<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable=[
        'provider_id',
        'purchase_date',
        'invoice_number',
        'state',
        'total'
    ];

    public function provider(){
        //relacion inversa con proveedores
        return $this->belongsTo(Provider::class);
    }

    public function products(){
        //relacion muchos a muchos productos compras
        return $this->belongsToMany(Product::class)->withPivot(
                                                        'quantity',
                                                        'purchase_price',
                                                        'subtotal',
                                                        'color',
                                                        'size');

    }
}
