<?php

namespace App\Models;
use App\Models\Product_purchases;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;




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

    public function provider(): BeLongsTo{
        //relacion inversa con proveedores
        return $this->belongsTo(Provider::class);
    }


public function Product_purchases(): HasMany
{
    return $this->hasmany(Product_purchases::class);
}

/*
    public function products(){
        //relacion muchos a muchos productos compras
        return $this->belongsToMany(Product::class)->withPivot(
                                                        'quantity',
                                                        'purchase_price',
                                                        'subtotal',
                                                        'color',
                                                        'size');

    }

    */
}
