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
        Schema::create('category_portfolio_item', function (Blueprint $table) {
            $table->primary(['category_id', 'portfolio_item_id']);

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('portfolio_item_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_portfolio_item');
    }
};
