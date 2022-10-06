<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\StockService as ServicesStockService;
use Illuminate\Support\Facades\Log;
use Throwable;

class TwStockFewInfo extends Command
{

    private $stockservice;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:fewinfo {skip} {take}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect info of Taiwan Few stock today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->stockservice = new ServicesStockService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Start collecting Taiwan stock information today');
        $all = $this->stockservice->getStockOverviewFromSQL(false, $this->argument('skip'), $this->argument('take'));
        $num = 0;
        try {
            foreach ($all as $key => $value) {
                $this->stockservice->saveFewStocksDataToCsv($value['stock_id']);
                $num++;
            }
        } catch (Throwable $e) {
            report($e);
            Log::info("The ${num} piece of info has been collected");
        }

        Log::info("The ${num} piece of information has been collected");
        Log::info("Collected today's Taiwan stock info");
        return;
    }
}
