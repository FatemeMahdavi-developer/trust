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
        Schema::table('employments', function (Blueprint $table) {
            $table->string("tell2");
            $table->enum('married',['1','2']);
            $table->enum("it_office",['1','2','3','4','5']);
            $table->enum("it_accounting",['1','2','3','4','5']);
            $table->enum("it_internet",['1','2','3','4','5']);
            $table->enum("it_social",['1','2','3','4','5']);
            $table->enum("it_designing",['1','2','3','4','5']);
            $table->enum("it_it",['1','2','3','4','5']);
            $table->string("it_note")->nullable();
            $table->text("note_more")->nullable();
            $table->string("reagent_tell")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employments', function (Blueprint $table) {
            $table->dropColumn("tell2");
            $table->dropColumn("married");
            $table->dropColumn("it_office");
            $table->dropColumn("it_accounting");
            $table->dropColumn("it_internet");
            $table->dropColumn("it_social");
            $table->dropColumn("it_designing");
            $table->dropColumn("it_it");
            $table->dropColumn("it_note");
            $table->dropColumn("note_more");
            $table->dropColumn("reagent_tell");

        });
    }
};
