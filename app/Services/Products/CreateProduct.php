<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Services\Products\GenerateProductCode;

class CreateProduct
{  
    /**
     * @var \App\Services\Products\GenerateProductCode $generateProductCode
     */
    protected $generateProductCode;

    /**
     * @param \App\Services\Products\GenerateProductCode $generateProductCode
     */
    public function __construct(GenerateProductCode $generateProductCode)
    {
        $this->generateProductCode = $generateProductCode;
    }

    /**
     * Execute 
     * 
     * @param array $data
     * @return void
     */
    public function execute($data)
    {
        $data['code'] = $this->generateProductCode->execute();
        Product::create($data);
    }
}