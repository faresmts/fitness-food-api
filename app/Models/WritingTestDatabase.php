<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


/**
 * @property string $foo
 */
class WritingTestDatabase extends Model
{
    use HasFactory;

    CONST TEST_STRING = 'database_writing_test';
    protected $connection = 'mongodb';
    protected $collection = 'writing_test';
}
