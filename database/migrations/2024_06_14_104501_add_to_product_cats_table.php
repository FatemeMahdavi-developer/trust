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
        Schema::table('product_cats', function (Blueprint $table) {
            $table->enum('state_menu',['0','1'])->default(0)->after('state');
            $table->enum('state_main',['0','1'])->default(0)->after('state_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_cats', function (Blueprint $table) {
            $table->dropColumn("state_menu");
            $table->dropColumn("state_main");
        });
    }
};
