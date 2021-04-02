<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Exceptions\Products\ProductIsNotFoundException;

class DeleteProduct
{  
    /**
     * Execute 
     * 
     * @param int $id
     * @return void
     */
    public function execute($id)
    {
        $product = Product::find($id);
        if (is_null($product))
            throw new ProductIsNotFoundException();
        $product->delete();
    }
}