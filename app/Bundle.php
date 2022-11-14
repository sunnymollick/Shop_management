<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_products');
    }
}

