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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string("name", 64);
            $table->string("name_en", 64);
            $table->integer("capital_city");
            $table->enum("state", ["0", "1"])->default("0");
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string("name", 64);
            $table->string("name_en", 64);
            $table->integer("country");
            $table->decimal("latitude",10,8)->nullable();
           $table->decimal("longitude",11,8)->nullable();
            $table->enum("state", ["0", "1"])->default("0");
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string("name", 64);
            $table->string("name_en", 64)->nullable();
            $table->integer("province");
            $table->decimal("latitude",10,8)->nullable();
            $table->decimal("longitude",11,8)->nullable();
            $table->enum("state", ["0", "1"])->default("0");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('cities');
    }
};
