<?php
namespace App\Http\Services;

use App\Models\TwStockInfo;
use GuzzleHttp\Client;
use App\Http\Services\StockSearchService;

class StockService
{
     /** @var Client  */
    private $client;
    private $stockApiUrl;
    private $stockSearch;
    public function __construct()
    {
        $this->client = new Client;
        $this->stockSearch = new StockSearchService;
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

    public function getFewStocksInfo($stock_id)
    {
        $stockInfo = TwStockInfo::where('stock_id', '=', $stock_id)->firstOrFail();
        return $stockInfo;
    }

    public function saveFewStocksDataToCsv($stock_id)
    {
        $data = $this->getFewStocksData($stock_id);
        $data = $data['data'];

        if (empty($data)) return;

        $path = public_path('/docs/stock/');
        $fileName = $stock_id . '.csv';
        
        $file = fopen($path . $fileName, 'w');

        $columns = ['date', 'stock_id', 'Trading_Volume', 'Trading_money', 'open', 'max', 'min', 'close', 'spread', 'Trading_turnover'];
        fputcsv($file, $columns);

        foreach ($data as $key => $value) {
            $info = [];
            foreach ($value as $k => $v) {
                array_push($info, $v);
            }
            fputcsv($file, $info);
        }
        
        fclose($file);
    }
    
    public function getStockOverviewFromSQL(bool $all = true,int $skip = 0, int $take = 100)
    {
        $stocks = $all 
                ? TwStockInfo::all()
                : TwStockInfo::all()->skip($skip)->take($take);
        $info = [];
        
        foreach ($stocks as $key => $stock) {
            $info[] = $stock->getAttributes();
        }
        return $info;
    }

    public function getFewStockDataFromCsv($stock_id)
    {
        $stock_id = strval($stock_id);
        $path = public_path('/docs/stock/');
        $data = [];
        $row = [];

        // csv to array    
        $fileName = $stock_id . '.csv';
        if (file_exists($path . $fileName)) {
            $file = fopen($path . $fileName, 'r');
        } else {
            return;
        }
        $row = fgetcsv($file);
        while(! feof($file)) {
            $data[] = fgetcsv($file);
        }
        fclose($file);

        // delete last empty array
        $lastValue = (count($data) - 1);
        unset($data[$lastValue]);

        // change data row
        foreach ($data as $key => $value) {
            foreach ($row as $k => $v) {
                $value[$v] = $value[$k];
                unset($value[$k]);

            }
            $data[$key] = $value;
        }
        return $data;
    }

    public function analyticStock($info = null)
    {
        $Allstock = $this->getStockOverviewFromSQL(false, 0, 300);

        $Alldata = [];
        // catch all stock data
        foreach ($Allstock as $key => $value) {
            $data = $this->getFewStockDataFromCsv($value['stock_id']);
            if (!empty($data)) $Alldata[$value['stock_id']] = $data;
        }

        $info = $info->input();
        unset($info['_token']);

        // condition judge
        foreach ($info as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'price_greater':
                        $Alldata = $this->stockSearch->priceGreater($info['price_greater'], $Alldata);
                        break;
                }
            }
        }

        $meetStock = array_keys($Alldata);

        return $meetStock;
    }
}