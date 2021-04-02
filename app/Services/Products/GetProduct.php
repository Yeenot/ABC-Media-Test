<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Exceptions\Products\ProductIsNotFoundException;

class GetProduct
{  
    /**
     * Execute 
     * 
     * @return \App\Models\Product
     */
    public function execute($id)
    {
        $product = Product::find($id);
        if (is_null($product))
            throw new ProductIsNotFoundException();
        return $product;
    }
}