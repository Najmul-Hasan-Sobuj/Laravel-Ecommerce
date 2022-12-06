<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',
        'name',
        'code',
        'color',
        'size',
        'unit',
        'tags',
        'video',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'warehouse',
        'description',
        'thumbnail',
        'images_slider',
        'featured',
        'today_deal',
        'status',
        'flash_deal_id',
        'cash_on_delivery',
        'admin_id',
        'category_id',
        'sub_category_id'
    ];
}
