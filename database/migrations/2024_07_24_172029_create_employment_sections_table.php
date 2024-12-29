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
        Schema::create('employment_sections', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->foreignId("admin_id")->nullable()->constrained("admins")->nullOnDelete()->cascadeOnUpdate();
            $table->string("name");
            $table->enum('state',[0,1])->default(0);
            $table->integer('order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_sections');
    }
};
