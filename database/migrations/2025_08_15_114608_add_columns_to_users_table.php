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
            $table->boolean('locker_bank_owner')->default(0)->after('lastname');
            $table->boolean('legal_information_check')->default(0)->after('gender');
            $table->string('company')->nullable()->after("legal_information_check");
            $table->string('economic_code',11)->nullable()->after("company");
            $table->string('national_id',11)->nullable()->after("economic_code");
            $table->string("tell2",20)->nullable()->after("national_id");
            $table->string('registration_number',20)->nullable()->after("tell2");
            $table->foreignId('province2')->nullable()->constrained("provinces")->cascadeOnUpdate()->nullOnDelete()->after("registration_number");
            $table->foreignId('city2')->nullable()->constrained("cities")->cascadeOnUpdate()->nullOnDelete()->after("province2");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('locker_bank_owner');
            $table->dropColumn('legal_information_check');
            $table->dropColumn('company');
            $table->dropColumn('economic_code');
            $table->dropColumn('national_id');
            $table->dropColumn('tell2');
            $table->dropColumn('registration_number');
            $table->dropForeign(['province2']);
            $table->dropColumn('province2');
            $table->dropForeign(['city2']);
            $table->dropColumn('city2');
        });
    }
};
