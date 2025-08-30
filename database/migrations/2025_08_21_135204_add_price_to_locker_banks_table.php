<?php

use App\Base\Entities\Enums\PricingType;
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
        Schema::table('locker_banks', function (Blueprint $table) {
            $table->unsignedInteger('price')->nullable()->after('branch_id');
            $table->enum('pricing_type', array_map(fn($case) => $case->value, PricingType::cases()))->after('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locker_banks', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('pricing_type');
        });
    }
};
