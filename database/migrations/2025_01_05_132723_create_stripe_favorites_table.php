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
        Schema::create('stripe_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stripe_id')->constrained(
                table: 'stripe', indexName: 'stripe_favorites_stripe_id'
            );
            $table->boolean('is_favorited')->default(false);
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_favorites');
    }
};
