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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->bigInteger("user_id");
            $table->text('note')->nullable();
            $table->integer("admin_id")->default("1");
            $table->text('response_note')->nullable();
            $table->timestamp('response_created_at')->nullable();
            $table->morphs("commentable");
            $table->integer("count_like")->default(0);
            $table->integer("count_dislike")->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
