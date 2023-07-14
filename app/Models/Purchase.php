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
        'total',
        'balance',
        'payment_method'
    ];

    public function provider(): BeLongsTo{
        //relacion inversa con proveedores
        return $this->belongsTo(Provider::class);
    }


public function product_purchases(): HasMany
{
    return $this->hasmany(Product_purchases::class);
}

public function creditpurchases(): HasMany
{
    return $this->hasmany(Creditpurchase::class);
}


}
