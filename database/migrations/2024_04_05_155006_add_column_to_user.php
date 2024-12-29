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
        Schema::table('users', function (Blueprint $table) {
            $table->string("lastname")->after("name");
            $table->string("mobile")->nullable();
            $table->timestamp('expire_confirm_at')->nullable();
            $table->string("confirm_code")->nullable();
            $table->string("username")->unique();
            $table->enum('state',['0','1'])->default('0');
            $table->integer('province')->nullable();
            $table->integer('city')->nullable();
            $table->string('national_code')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender',['1','2'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("lastname");
            $table->dropColumn("mobile");
            $table->dropColumn('expire_confirm_at');
            $table->dropColumn("confirm_code");
            $table->dropColumn("username");
            $table->dropColumn("state");
            $table->dropColumn("province");
            $table->dropColumn("city");
            $table->dropColumn("national_code");
            $table->dropColumn("postal_code");
            $table->dropColumn("address");
            $table->dropColumn("gender");
        });
    }
};
