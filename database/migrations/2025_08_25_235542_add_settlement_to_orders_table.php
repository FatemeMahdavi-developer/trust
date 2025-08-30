<?php

use App\Base\Entities\Enums\SettlementStatusOfOrder;
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
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('settlement_status',array_map(fn($case) =>$case->value,SettlementStatusOfOrder::cases()))
                ->default(SettlementStatusOfOrder::PENDING->value)->after('ref_number');
            $table->timestamp('settled_at')->nullable()->after('settlement_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('settlement_status');
            $table->dropColumn('settled_at');
        });
    }
};
