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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string("lang",5)->default("fa");
            $table->foreignId('admin_id')->constrained()->nullable()->onUpdate('cascade');
            $table->string('state',30)->default(0)->nullable();
            $table->integer("order")->default("0");
            $table->string('title');
            $table->string("note")->nullable();
            $table->string("price")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
