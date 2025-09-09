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
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // Ex: "Gloria Jenkins"
            $table->text('description')->nullable();
            $table->string('cover_image'); // L'image de couverture principale

            // La clé pour les carrousels !
            // On stocke un tableau de chemins d'images.
            $table->json('images')->nullable();

            $table->string('video_url')->nullable(); // Pour les liens Vimeo/Youtube
            $table->boolean('is_visible')->default(true); // Pour publier/dépublier
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};
