<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function App\Helpers\admin\makeDefaultColumns;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string("lang",5)->default("fa");
            $table->foreignId('admin_id')->constrained()->nullable()->onUpdate('cascade');
            $table->string('title')->nullable();
            $table->string('state')->default('empty');
            $table->string('number_box');
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
        Schema::dropIfExists('boxes');
    }
};
