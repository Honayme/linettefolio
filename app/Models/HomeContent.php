<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'greeting_text',
        'main_title',
        'description',
        'cta_button_text',
        'cta_button_url',
        'hero_image',
        'hero_image_alt',
    ];
}
