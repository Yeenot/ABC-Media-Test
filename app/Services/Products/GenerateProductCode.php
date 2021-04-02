<?php

namespace App\Services\Products;

use App\Services\Products\IsProductCodeExist;
 
class GenerateProductCode
{
    /**
     * @var \App\Services\Products\IsProductCodeExist $isProductCodeExist
     */
    protected $isProductCodeExist;

    /**
     * @param \App\Services\Products\IsProductCodeExist $isProductCodeExist
     */
    public function __construct(IsProductCodeExist $isProductCodeExist)
    {
        $this->isProductCodeExist = $isProductCodeExist;
    }
    
    /**
     * Generate product code
     *
     * @return string
     */
    public function execute()
    {   
        do{
            $number = mt_rand(10000000, 99999999);
            $code = "PR{$number}";
        }while($this->isProductCodeExist->execute($code));

        return $code;
    }
}