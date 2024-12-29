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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->integer("admin_id")->nullable();
            $table->string("name");
            $table->string("email");
            $table->string("mobile");
            $table->foreignId("catid")->nullable()->constrained("message_cats")->cascadeOnUpdate()->nullOnDelete();
            $table->text("note");
            $table->string("ip_address");
            $table->string("answer_title")->nullable();
            $table->text("answer_note")->nullable();
            $table->enum("state",["0","1"])->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
