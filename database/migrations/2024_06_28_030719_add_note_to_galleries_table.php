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
        Schema::table('galleries', function (Blueprint $table) {
            $table->text('note')->after('alt_pic_banner')->nullable();
            $table->string('video')->after('note')->nullable();
            $table->enum('is_aparat',[0,1])->after('video')->default(0);
            $table->text('aparat_video')->after('is_aparat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn("note");
            $table->dropColumn('video');
            $table->dropColumn('is_aparat');
            $table->dropColumn('aparat_video');
        });
    }
};
