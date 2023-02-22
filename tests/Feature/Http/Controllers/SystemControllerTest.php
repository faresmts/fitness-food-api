<?php

it('behaves as expected when getting system info', function () {
    $response = $this->get(route('system.info'));
    $response->assertOk();
    $response->assertJsonStructure([
        'db_connection',
        'db_writing',
        'last_cron_time',
        'online_time',
        'memory_use'
    ]);
});
