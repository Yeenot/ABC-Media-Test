<?php

namespace App\Services\Products;

use App\Models\Product;

class IsProductCodeExist
{
    /**
     * Check if product code already exists
     * 
     * @param string $code
     * @return bool
     */
    public function execute($code)
    {
        return Product::where('code', $code)->count() > 0;
    }
}