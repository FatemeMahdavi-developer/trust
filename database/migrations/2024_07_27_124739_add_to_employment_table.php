<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employments', function (Blueprint $table) {
            $table->enum("hit",[0,1])->default(0)->after('state');
            DB::statement("ALTER TABLE `employments` CHANGE `condemnation` `condemnation` ENUM('1','2') NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `illness` `illness` ENUM('1','2') NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `work_evening` `work_evening` ENUM('1','2') NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `work_operant` `work_operant` ENUM('1','2') NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `work_holidays` `work_holidays` ENUM('1','2') NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `insurance_history` `insurance_history` ENUM('1','2') NULL;");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employments', function (Blueprint $table) {
            $table->dropColumn('hit');
            DB::statement("ALTER TABLE `employments` CHANGE `condemnation` `condemnation` ENUM('0','1') NOT NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `illness` `illness` ENUM('0','1') NOT NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `work_evening` `work_evening` ENUM('0','1') NOT NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `work_operant` `work_operant` ENUM('0','1') NOT NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `work_holidays` `work_holidays` ENUM('0','1') NOT NULL;");
            DB::statement("ALTER TABLE `employments` CHANGE `insurance_history` `insurance_history` ENUM('0','1') NOT NULL;");
        });
    }
};
