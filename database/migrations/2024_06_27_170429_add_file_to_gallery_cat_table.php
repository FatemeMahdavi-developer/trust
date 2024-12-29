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
        Schema::table('gallery_cats', function (Blueprint $table) {
            $table->dropUnique(['seo_url']);
            $table->unique(['seo_url','kind']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_cats', function (Blueprint $table) {
            $table->unique(['seo_url']);
            $table->dropUnique(['seo_url','kind']);
        });
    }
};
