<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $casts = [
    	'categories' => 'array',
    	'product_sizes' => 'array',
    ];
}
