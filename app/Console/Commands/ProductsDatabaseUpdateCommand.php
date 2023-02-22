<?php

namespace App\Console\Commands;

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
    }
}
