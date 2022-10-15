<?php
namespace App\Http\Services;

class StockSearchService
{
    public function priceGreater(int $price,array $data)
    {
        foreach ($data as $key => $value) {
            $lastDayPrice = count($value) - 1;
            if ($value[$lastDayPrice]['close'] < $price) unset($data[$key]);
        }
        return $data;
    }
}

