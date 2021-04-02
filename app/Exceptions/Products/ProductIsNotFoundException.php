<?php

namespace App\Exceptions\Products;

use App\Exceptions\Exception;

class ProductIsNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $key = "products_is_not_found";

    /**
     * @var int
     */
    protected $code = 400;
}