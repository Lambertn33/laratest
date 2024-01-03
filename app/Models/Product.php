<?php

namespace App\Models;

use App\Http\Services\ProductsServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    protected $appends = ['price_gbp'];

    public function getPriceGbpAttribute()
    {
        return $this->price / 2;
    }

    public function checkPriceEvenOrOdd(): string
    {
        return (new ProductsServices)->returnIsPriceOddOrEven($this->price);
    }
}
