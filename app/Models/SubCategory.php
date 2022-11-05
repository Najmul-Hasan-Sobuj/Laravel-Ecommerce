<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['category_id', 'sub_category_name', 'sub_category_slug']; //
}
