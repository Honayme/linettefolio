<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;

    protected $fillable = [
        // Informations principales
        'page_title',
        'hero_image',
        'hero_image_alt',
        'full_name',
        'job_title',
        'description',

        // Informations personnelles
        'address',
        'email',
        'phone',
        'driving_license',
        'nationality',
        'education_school',
        'education_degree',
        'languages',

        // Skills
        'skills_section1_title',
        'skills_section2_title',
        'skills_graphism',
        'skills_marketing',

        // Outils et centres d'intérêt
        'tools_section_title',
        'interests_section_title',
        'tools_list',
        'interests_list',

        // Formations et expériences
        'education_section_title',
        'experience_section_title',
        'education_items',
        'experience_items',

        // CV
        'cv_file',
    ];

    protected $casts = [
        'skills_graphism' => 'array',
        'skills_marketing' => 'array',
        'tools_list' => 'array',
        'interests_list' => 'array',
        'education_items' => 'array',
        'experience_items' => 'array',
    ];
}
