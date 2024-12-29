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
        Schema::create('contactmaps', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->integer("admin_id")->default("1");
            $table->string("lgmap")->default("51.422050867276866");
            $table->string("qgmap")->default("35.767638247435");
            $table->tinyInteger("zgmap")->unsigned()->default("18");
            $table->text("cgmap")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactmaps');
    }
};
