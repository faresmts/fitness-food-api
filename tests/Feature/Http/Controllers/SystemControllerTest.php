<?php

use App\Models\Cron;

beforeEach(fn () => Cron::factory()->create());

it('behaves as expected when getting system info', function () {
    $response = $this->get(route('system.info'));
    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'db_connection',
            'db_writing',
            'last_cron_time',
            'online_since',
            'memory_use'
        ]
    ]);
});
