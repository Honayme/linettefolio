<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();

            // Informations principales
            $table->string('page_title');
            $table->string('hero_image')->nullable();
            $table->string('hero_image_alt')->nullable();
            $table->string('full_name');
            $table->string('job_title');
            $table->text('description');

            // Informations personnelles
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('nationality')->nullable();
            $table->string('education_school')->nullable();
            $table->string('education_degree')->nullable();
            $table->string('languages')->nullable();

            // Skills avec pourcentages (JSON)
            $table->string('skills_section1_title');
            $table->string('skills_section2_title');
            $table->json('skills_graphism'); // [{"name": "Suite Adobe", "percentage": 95}, ...]
            $table->json('skills_marketing'); // [{"name": "Salesforce", "percentage": 90}, ...]

            // Outils et centres d'intérêt (JSON)
            $table->string('tools_section_title');
            $table->string('interests_section_title');
            $table->json('tools_list'); // ["Suite Adobe", "Marketing & Communication", ...]
            $table->json('interests_list'); // ["Voyages", "Randonnée", ...]

            // Formations et expériences (JSON)
            $table->string('education_section_title');
            $table->string('experience_section_title');
            $table->json('education_items'); // [{"period": "2020-2022", "school": "ESUPCOM", "degree": "Master..."}]
            $table->json('experience_items'); // [{"period": "2022-Présent", "company": "Pellenc ST", "position": "Chargée Marketing"}]

            // CV
            $table->string('cv_file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_contents');
    }
};
