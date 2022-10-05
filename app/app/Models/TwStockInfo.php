<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TwStockInfo extends Model
{
    use HasFactory;

    protected $table = 'tw_stock_info';
    protected $fillable = [
        'stock_name',
        'stock_id',
        'industry_category',
        'date'
    ];
}
