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
        Schema::create('message_cats', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->integer("admin_id")->default("1");
            $table->string("title");
            $table->string("email");
            $table->integer('catid')->default('0');
            $table->enum("state",["0","1"])->default("0");
            $table->integer("order")->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_cats');
    }
};
