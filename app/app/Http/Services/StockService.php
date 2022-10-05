<?php
namespace App\Http\Services;

use App\Models\TwStockInfo;
use GuzzleHttp\Client;

class StockService
{
     /** @var Client  */
    private $client;
    private $stockApiUrl;
    public function __construct()
    {
        $this->client = new Client;
        $this->stockApiUrl = 'https://api.finmindtrade.com/api/v4/data?';
    }

    public function getStockOverview()
    {
        $query = [
            'dataset' => 'TaiwanStockInfo',
            'token' => env('FINNIND_API_TOKEN')
        ];
        $path = $this->stockApiUrl . http_build_query($query);
        $content = $this->client->get($path)->getBody()->getContents();
        $content = json_decode($content, true);

        foreach ($content['data'] as $key => $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            if (strlen($value['stock_id']) != 4 || ($value['date']) == 'None' || $value['type'] == 'tpex') continue;
            $data = [
                'stock_name' => $value['stock_name'],
                'stock_id' => $value['stock_id'],
                'date' => $value['date'],
                'industry_category' => $value['industry_category'],
            ];
            TwStockInfo::upsert($data, ['stock_name', 'stock_id', 'date', 'industry_category'], ['stock_id']);

            // TwStockInfo::where('stock_id', $value['stock_id'])->firstOrFail()->update($data);
        }
    }

    public function getFewStocksData($stock_id)
    {
        $date = strtotime('-10 month');
        $query = [
            'dataset' => 'TaiwanStockPrice',
            'data_id' => $stock_id,
            'start_date' => date('Y-m-d', $date),
            'end_date' => date('Y-m-d'),
            'token' => env('FINNIND_API_TOKEN')
        ];
        $path = $this->stockApiUrl . http_build_query($query);
        
        $content = $this->client->get($path)->getBody()->getContents();
        $content = json_decode($content, true);
        
        return $content;
    }
}