<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\StockService as ServicesStockService;
use Illuminate\Support\Facades\Log;

class TwStockOverview extends Command
{

    private $stockservice;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:overview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect an overview of Taiwan stocks today';

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
        $this->stockservice->getStockOverview();
        Log::info("Collected today's Taiwan stock overview");
        return;
    }
}
