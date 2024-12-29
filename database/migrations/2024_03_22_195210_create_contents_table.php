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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->morphs("contentable");
            $table->tinyInteger("kind");
            $table->string("pic")->nullable();
            $table->string("note")->nullable();
            $table->text("note_more")->nullable();
            $table->string("pic_video")->nullable();
            $table->string("video")->nullable();
            $table->string("catalog")->nullable();
            $table->enum("state",["0","1"])->default("0");
            $table->integer("order")->default("0");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
