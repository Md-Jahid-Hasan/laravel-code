<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id', 'variant_id', 'variant'
    ];

    public function product_varient_price(){
        return $this->belongsToMany(ProductVariantPrice::class);
    }
}