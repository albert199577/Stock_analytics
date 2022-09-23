<?php
namespace App\Http\Services;

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

    public function getOriginalData()
    {
        $path = "{$this->stockApiUrl}dataset=TaiwanStockInfo";
        $content = $this->client->get($path)->getBody()->getContents();

        // print_r(gettype($content));
        $content = json_decode($content, true);
        // print_r(gettype($content));
        foreach ($content['data'] as $key => $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
        // $content = $content['data'];
        // print_r($content['data']);
        
    }

    public function getIndividualStocksData($stock_id)
    {
        $date = strtotime('-2 month');
        $query = [
            'dataset' => 'TaiwanStockPrice',
            'data_id' => $stock_id,
            'start_date' => date('Y-m-d', $date),
            'end_date' => date('Y-m-d'),
        ];
        $path = $this->stockApiUrl . http_build_query($query);
        print_r($path);
        $content = $this->client->get($path)->getBody()->getContents();
        $content = json_decode($content, true);
        
        echo "<pre>";
        print_r($content);
        echo "</pre>";
        return $content['data'];
    }
}