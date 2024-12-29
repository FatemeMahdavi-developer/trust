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
        Schema::create('instagram', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("link")->nullable();
            $table->string("pic")->nullable();
            $table->string("alt_pic")->nullable();
            $table->enum("state",["0","1"])->default("0");
            $table->enum("state_main",["0","1"])->default("0");
            $table->integer("order")->default("0");
            $table->integer("admin_id")->default("1");
            $table->tinyInteger("lang")->default("1");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram');
    }
};
