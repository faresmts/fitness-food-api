<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property int $version
 * @property string $update_hour
 */
class SystemEnv extends Model
{
    use HasFactory;

    CONST CURRENT_SYSTEM_VERSION = 1;

    protected $connection = 'mongodb';
    protected $collection = 'system_env';
}
