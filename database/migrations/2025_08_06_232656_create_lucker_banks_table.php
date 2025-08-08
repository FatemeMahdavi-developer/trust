<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locker_banks', function (Blueprint $table) {
            $table->id();
            $table->string("code", 12);
            $table->string("size")->nullable();
            $table->text("qrcode")->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locker_banks');
    }
};
