<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    public function product_varient_price(){
        return $this->belongsToMany(ProductVariantPrice::class);
    }
}