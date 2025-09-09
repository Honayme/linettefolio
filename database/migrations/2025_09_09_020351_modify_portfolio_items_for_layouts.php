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
        Schema::table('portfolio_items', function (Blueprint $table) {
            // On définit les types de layouts possibles.
            // 'image' est un bon défaut.
            $layouts = ['image', 'slider', 'video', 'presentation'];
            $table->enum('layout', $layouts)
                ->default('image')
                ->after('description'); // Place la colonne à un endroit logique
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropColumn('layout');
        });
    }
};
