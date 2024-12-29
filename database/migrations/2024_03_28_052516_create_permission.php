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
        // Schema::create('permission', function (Blueprint $table) {
        //     $table->id();
        //     $table->string("name");
        //     $table->enum( "check_all",["0","1"])->default("0");
        //     $table->json("access");
        //     $table->integer("admin_id")->default("1");
        //     $table->softDeletes();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('permission');
    }
};
