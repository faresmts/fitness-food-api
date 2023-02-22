<?php

use App\Console\Commands\ProductsDatabaseUpdateCommand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('behaves as expected when the command is called', function () {
    $command = new ProductsDatabaseUpdateCommand();
    $command->handle();
})->assertDatabaseCount('products', 900);
