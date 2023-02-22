<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property string $_id
 * @property int $code
 * @property string $status
 * @property Carbon $imported_t
 * @property string $url
 * @property string $creator
 * @property Carbon $created_t
 * @property Carbon $last_modified_t
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
 * @property double $serving_quantity
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

    const STATUS = [
        'DRAFT' => 'draft',
        'TRASH' => 'trash',
        'PUBLISHED' => 'published'
    ];

    const NUTRISCORE_SCORE = [
        'MIN' => -15,
        'MAX' => 40
    ];

    const NUTRISCORE_GRADE = [
        'A' => 'a',
        'B' => 'b',
        'C' => 'c',
        'D' => 'd',
        'E' => 'e'
    ];
}

