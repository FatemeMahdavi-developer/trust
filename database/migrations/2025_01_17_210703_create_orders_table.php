<?php

use App\Base\Entities\Enums\SizeLocker;
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
            $table->foreignId('user_id')->constrained()->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('pay_way')->nullable();
            $table->string('type');
            $table->enum('size', array_map(fn($case) => $case->value, SizeLocker::cases()));
            $table->string('price');
            $table->foreignId('box_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->string('kind_payment');
            $table->string('state');
            $table->string('ref_number')->nullable();
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
