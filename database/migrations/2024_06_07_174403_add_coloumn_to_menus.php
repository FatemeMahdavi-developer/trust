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
        Schema::table('menu', function (Blueprint $table) {
            $table->renameColumn('address','url'); 
            $table->enum("select_page",["0","1"])->default("0");
            $table->string("pages")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->renameColumn("url","address");
            $table->dropColumn("select_page");
            $table->dropColumn("pages");
        });
    }
};
