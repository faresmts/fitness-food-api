<?php

use App\Console\Commands\ProductsDatabaseUpdateCommand;
use App\Services\ProductService;

it('behaves as expected when the command is called', function () {
    $command = new ProductsDatabaseUpdateCommand(new ProductService());
    $docsQuantity = $command->handle();

    expect($docsQuantity)->toBe(900);
});
