<?php

namespace App\Http\Services;

class ProductsServices
{
    public function returnIsPriceOddOrEven(int $price)
    {
        return $price % 2 === 0 ? 'Even price' : 'Odd price';
    }
}
