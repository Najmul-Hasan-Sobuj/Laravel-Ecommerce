<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['category_id', 'sub_category_id', 'child_category_name', 'child_category_slug', 'category_id', 'sub_category_id']; //

}
