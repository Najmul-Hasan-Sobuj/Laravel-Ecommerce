<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['brand_name', 'brand_slug', 'brand_logo', 'front_page'];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setBrandLogoAttribute($value)
    {
        $this->attributes['brand_logo'] = json_encode($value);
    }
}
