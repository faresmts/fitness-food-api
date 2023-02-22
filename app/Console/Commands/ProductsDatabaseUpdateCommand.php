<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProductsDatabaseUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products_database:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update database of products from open food facts data';

    private ProductService $service;

    public function __construct(ProductService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Log::info('executando');
        $dataCount = 0;
        foreach ( Product::URLS as $url){
            $fileName = 'https://challenges.coode.sh/food/data/json/' . $url;

            try {
                $dataCount += $this->tryUpdateData($fileName);
            }catch (Exception $e){
                Log::info($e->getMessage());
                sleep(60);
                $dataCount += $this->tryUpdateData($fileName);
                continue;
            }
        }

        return $dataCount;
    }

    private function tryUpdateData(string $fileName): int
    {
        $tryDataCount = 0;

        $file = gzopen($fileName, 'r');

        $lines = [];

        for($i = 0; $i < Product::MAX_PRODUCTS_READ; $i++) {
            if (! gzeof($file)){
                $lines[] = trim(gzgets($file));
                $tryDataCount++;
            }
        }
        gzclose($file);

        $jsons = [];
        foreach ($lines as $line){
            $jsons[] = json_decode($line);
        }

        $this->service->saveProductsFromArray($jsons);

        return $tryDataCount;
    }

}
