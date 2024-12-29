<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('photos', function (Blueprint $table) {
    //         $table->id();
    //         $table->tinyInteger("lang")->default("1");
    //         $table->integer("admin_id");
    //         $table->string("title");
    //         $table->integer('catid');
    //         $table->string("pic")->nullable();
    //         $table->string("alt_pic")->nullable();
    //         $table->enum("state",["0","1"])->default("0");
    //         $table->enum("state_main",["0","1"])->default("0");
    //         $table->integer("order")->default("0");
    //         $table->softDeletes();
    //         $table->timestamps();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('photos');
    // }
};
