<?php

use Database\Seeders\PagesSeeder;
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
        Schema::create('page_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('key');
            $table->string('type');
            $table->longText('textValue')->nullable();
            $table->longText('fileValue')->nullable();
            $table->boolean('booleanValue')->nullable();
            $table->text('metaValue')->nullable();
            $table->text('repeaterType')->nullable();
            $table->jsonb('repeaterValue')->nullable();
            $table->timestamps();
        });


        (new PagesSeeder())->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_attributes');
    }
};
