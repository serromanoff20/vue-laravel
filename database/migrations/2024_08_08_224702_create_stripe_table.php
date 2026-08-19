<?php

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use MigrationTableSchemaTrait;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stripe', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('model', 100);
            $table->string('description', 1000);
            $table->double('cost');
            $table->string('image', 255);
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe');
    }
};
