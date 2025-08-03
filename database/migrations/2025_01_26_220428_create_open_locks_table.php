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
        Schema::create('open_locks', function (Blueprint $table) {
            $table->id();
            $table->string("mobile")->unique();
            $table->tinyInteger("attempt");
            $table->string("code");
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_locks');
    }
};
