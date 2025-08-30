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
        Schema::table('baskets', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->after('box_id')->constrained('branches')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('locker_bank_id')->nullable()->after('branch_id')->constrained('locker_banks')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
            $table->dropForeign(['locker_bank_id']);
            $table->dropColumn('locker_bank_id');
        });
    }
};
