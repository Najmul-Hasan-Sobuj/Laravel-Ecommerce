<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['currency', 'phone_one', 'phone_two', 'main_email', 'support_email', 'logo', 'favicon', 'address', 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
}
