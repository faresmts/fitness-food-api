<?php

use App\Console\Commands\ProductsDatabaseUpdateCommand;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

//uses(RefreshDatabase::class);

it('behaves as expected when the command is called', function () {
    $command = new ProductsDatabaseUpdateCommand(new ProductService());
    $docsQuantity = $command->handle();

    expect($docsQuantity)->toBe(900);
});
