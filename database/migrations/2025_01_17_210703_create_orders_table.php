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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basket_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_id')->constrained()->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('type');
            $table->string('size_title');
            $table->string('price');
            $table->string('number_box');
            $table->string('kind_payment');
            $table->string('state');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
