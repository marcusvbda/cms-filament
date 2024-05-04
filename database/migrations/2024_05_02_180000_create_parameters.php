<?php

use Database\Seeders\ParametersSeeder;
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
        Schema::create('parameters', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('label');
            $table->text('value')->nullable();
            $table->json('attributes')->nullable();
            $table->string('type');

            $table->timestamps();
        });
        (new ParametersSeeder())->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
