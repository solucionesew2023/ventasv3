<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creditpurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'typepay',
        'purchase_id',
        'valuepay',
        'notes',
        'evidence'
            ];

            public function purchase():BelongsTo{
                return $this->belongsTo(Purchase::class);
            }
}
