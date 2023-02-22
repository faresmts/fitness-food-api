<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property Carbon $runtime_date
 * @property string $errors
 * @property bool $sucess
 * @property string $inserted_quantity
 */
class Cron extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = 'mongodb';
    protected $collection = 'crons';
}
