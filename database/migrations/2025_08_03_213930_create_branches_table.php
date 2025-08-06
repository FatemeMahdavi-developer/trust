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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->foreignId('admin_id')->constrained()->nullable()->onUpdate('cascade');
            $table->enum("state",["0","1"])->default("0");
            $table->enum("state_main",["0","1"])->default("0");
            $table->integer("order")->default("0");
            $table->string('name');
            $table->string('address');
            $table->string('code');
            $table->string('lgmap');
            $table->string('qgmap');
            $table->string('postal_code',10);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
