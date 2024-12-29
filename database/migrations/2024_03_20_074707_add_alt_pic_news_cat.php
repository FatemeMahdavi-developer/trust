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
        Schema::table('news_cats', function (Blueprint $table) {
            $table->enum("state",["0","1"])->default("0")->after("pic_banner");
            $table->integer("order")->default("0")->after("pic_banner");
            $table->string("alt_pic")->nullable()->after("pic_banner");
            $table->string("pic_banner")->change()->nullable();
            $table->tinyInteger("lang")->default("1")->after("id");
            $table->integer("admin_id")->default("1")->after("lang");
            $table->softDeletes()->after("alt_pic");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_cats', function (Blueprint $table) {
            $table->dropColumn("alt_pic");
            $table->dropColumn("state");
            $table->string("pic_banner")->change()->nullable(false);
            $table->dropColumn("lang");
            $table->dropColumn("order");
            $table->dropColumn("admin_id");
            $table->dropSoftDeletes();
        });
    }
};
