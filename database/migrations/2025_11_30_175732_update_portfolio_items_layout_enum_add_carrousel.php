<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifier l'ENUM pour remplacer 'slider' par 'carrousel'
        DB::statement("ALTER TABLE portfolio_items MODIFY COLUMN layout ENUM('image', 'video', 'presentation', 'carrousel') NOT NULL DEFAULT 'image'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revenir à l'ancien ENUM avec 'slider'
        DB::statement("ALTER TABLE portfolio_items MODIFY COLUMN layout ENUM('image', 'slider', 'video', 'presentation') NOT NULL DEFAULT 'image'");
    }
};
