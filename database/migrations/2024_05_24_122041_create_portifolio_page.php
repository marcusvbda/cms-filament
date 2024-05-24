<?php

use App\Models\Page;
use Database\Seeders\PagesSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        (new PagesSeeder)->run("createPortifolioPage");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Page::where('slug', 'mvbassalobre')->delete();
    }
};
