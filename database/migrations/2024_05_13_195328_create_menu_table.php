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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->tinyInteger('type');
            $table->string("pic")->nullable();
            $table->string("alt_pic")->nullable();
            $table->enum("state",["0","1"])->default("0");
            $table->integer("order")->default("0");
            $table->tinyInteger("open_type")->default("0");
            $table->integer("catid")->default("0");
            $table->tinyInteger("lang")->default("1");
            $table->integer("admin_id")->default("1");
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
