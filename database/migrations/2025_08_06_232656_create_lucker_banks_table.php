<?php

use App\Base\Entities\Enums\SizeLocker;
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
            $table->string("code", 12)->unique();
            $table->enum('size', array_map(fn($case) => $case->value, SizeLocker::cases()))->nullable();
            $table->text("qrcode")->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->cascadeOnUpdate();
            $table->unique(['branch_id', 'size']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locker_banks', function (Blueprint $table) {
            $table->dropUnique(['branch_id', 'size']);
        });
        Schema::dropIfExists('locker_banks');
    }
};
