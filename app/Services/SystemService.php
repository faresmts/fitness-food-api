<?php

namespace App\Services;

use App\Models\Cron;
use App\Models\SystemEnv;
use App\Models\WritingTestDatabase;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class SystemService
{
    public function getSystemData(): Cron
    {
        /**
         * @var Cron $data
         */
        $data = Cron::query()->latest()->first();

        $connection = DB::connection('mongodb');

        $data->dbConnection = '🔴 OFF';
        $data->dbWriting = '🔴 OFF';

        if($connection->getDatabaseName() === SystemEnv::DATABASE_NAME){
            $data->dbConnection = '🟢 ON';
        }

        $writingTest = new WritingTestDatabase();
        $writingTest->foo = WritingTestDatabase::TEST_STRING;
        $writingTest->save();

        $writingData = WritingTestDatabase::where('foo', '=', WritingTestDatabase::TEST_STRING)->first();

        if($writingData){
            $data->dbWriting = '🟢 ON';
            WritingTestDatabase::truncate();
        }

        $processTime = new Process(['uptime','-p']);
        $processTime->run();
        $data->onlineTime = trim($processTime->getOutput());

        $processMemory = new Process(['free','-h', '-t']);
        $processMemory->run();
        $memoryData = explode('Total:', $processMemory->getOutput());
        $memoryTotal = explode(' ', $memoryData[1]);
        $memoryUsed = $memoryTotal[17];

        $data->memoryUse = trim($memoryUsed);

        return $data;
    }
}
