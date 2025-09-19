<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mettre à jour tous les éléments avec layout 'slider' vers 'image'
        DB::table('portfolio_items')
            ->where('layout', 'slider')
            ->update(['layout' => 'image']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remettre les éléments modifiés vers 'slider' (rollback)
        DB::table('portfolio_items')
            ->where('layout', 'image')
            ->update(['layout' => 'slider']);
    }
};
