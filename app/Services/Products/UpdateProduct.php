<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Exceptions\Products\ProductIsNotFoundException;

class UpdateProduct
{  
    /**
     * Execute 
     * 
     * @param int $id
     * @param array $data
     * @return void
     */
    public function execute($id, $data)
    {
        $product = Product::find($id);
        if (is_null($product))
            throw new ProductIsNotFoundException();
        $product->update($data);
    }
}