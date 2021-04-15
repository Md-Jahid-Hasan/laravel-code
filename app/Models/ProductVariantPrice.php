<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
    public function product_varient(){
        return $this->belongsTo(ProductVariant::class);
    }
}
