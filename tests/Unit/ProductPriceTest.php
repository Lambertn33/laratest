<?php

namespace Tests\Unit;

use App\Http\Services\ProductsServices;
use PHPUnit\Framework\TestCase;

class ProductPriceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_price_should_return_correct_even_or_odd(): void
    {
        $this->assertEquals('Odd price', (new ProductsServices)->returnIsPriceOddOrEven(3001));
    }
}
