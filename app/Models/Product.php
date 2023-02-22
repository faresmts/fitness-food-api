<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property string $code
 * @property string $status
 * @property string $imported_t
 * @property string $url
 * @property string $creator
 * @property string $created_t
 * @property string $last_modified_t
 * @property string $product_name
 * @property string $quantity
 * @property string $brands
 * @property string $categories
 * @property string $labels
 * @property string $cities
 * @property string $purchase_places
 * @property string $stores
 * @property string $ingredients_text
 * @property string $traces
 * @property string $serving_size
 * @property ?double $serving_quantity
 * @property int $nutriscore_score
 * @property string $nutriscore_grade
 * @property string $main_category
 * @property string $image_url
 * */
class Product extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'products';

    CONST STATUS = [
        'DRAFT' => 'draft',
        'TRASH' => 'trash',
        'PUBLISHED' => 'published'
    ];

    CONST NUTRISCORE_SCORE = [
        'MIN' => -15,
        'MAX' => 40
    ];

    CONST NUTRISCORE_GRADE = [
        'A' => 'a',
        'B' => 'b',
        'C' => 'c',
        'D' => 'd',
        'E' => 'e'
    ];

    CONST MAX_PRODUCTS_READ = 100;

    CONST URLS = [
        'products_01.json.gz',
        'products_02.json.gz',
        'products_03.json.gz',
        'products_04.json.gz',
        'products_05.json.gz',
        'products_06.json.gz',
        'products_07.json.gz',
        'products_08.json.gz',
        'products_09.json.gz'
    ];
}
