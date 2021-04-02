<?php

namespace App\Services\Products;

use App\Models\Product;

class GetProducts
{  
    /**
     * Execute 
     * 
     * @return \Illuminate\Database\Eloquent\Collection<App\Models\Product>
     */
    public function execute()
    {
        return Product::search(['code', 'name'])
            ->getPaginate();
    }
}