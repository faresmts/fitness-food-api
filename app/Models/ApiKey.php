<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property int $user
 * @property string $key
 */
class ApiKey extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'api_keys';
}
