<?php

namespace App\Console\Commands;

use App\Models\Cron;
use App\Models\Product;
use App\Services\ProductService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

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
        $dataCount = 0;
        $errors = [];
        foreach ( Product::URLS as $url){
            $fileName = 'https://challenges.coode.sh/food/data/json/' . $url;

            try {
                $dataCount += $this->tryUpdateData($fileName);
            }catch (Exception $e){
                $errors[] = $e->getMessage();
                sleep(60);
                $dataCount += $this->tryUpdateData($fileName);
                continue;
            }
        }

        $cron = new Cron();
        $cron->sucess = $dataCount === 900;
        $cron->errors = json_encode($errors);
        $cron->runtime_date = Carbon::now()->format('Y-m-d H:i:s');
        $cron->inserted_quantity = $dataCount;

        $cron->save();

        return $dataCount;
    }

    private function tryUpdateData(string $fileName): int
    {
        $tryDataCount = 0;

        try{
            $file = gzopen($fileName, 'r');
        }catch (Exception $e){
            sleep(60);
            $tryDataCount += $this->tryUpdateData($fileName);
            return $tryDataCount;
        }

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
