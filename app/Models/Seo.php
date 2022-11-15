<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['meta_title', 'meta_author', 'meta_tag', 'meta_description', 'google_verification', 'google_analytics', 'alexa_verification', 'google_adsense_'];

    /**
     * Set the Seo
     *
     */
    public function setMetaTagAttribute($value)
    {
        $this->attributes['meta_tag'] = json_encode($value);
    }

    /**
     * Get the Seo
     *
     */
    // public function getMetaTagAttribute($value)
    // {
    //     return $this->attributes['meta_tag'] = json_decode($value);
    // }
}
