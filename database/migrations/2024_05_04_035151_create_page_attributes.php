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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->morphs('entity');
            $table->string('key');
            $table->string('type');
            $table->string('componentValue')->nullable();
            $table->longText('textValue')->nullable();
            $table->longText('fileValue')->nullable();
            $table->boolean('booleanValue')->nullable();
            $table->longText('metaValue')->nullable();
            $table->text('repeaterType')->nullable();
            $table->jsonb('repeaterValue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_attributes');
    }
};
