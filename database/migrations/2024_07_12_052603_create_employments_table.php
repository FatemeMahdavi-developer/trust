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

        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("lang")->default("1");
            $table->integer("admin_id");
            $table->string("name");
            $table->string("middle_name");
            $table->integer("province");
            $table->integer("city");
            $table->timestamp('date_birth');
            $table->string("place_issue");
            $table->string("national_code");
            $table->string("religion");
            $table->string("mobile");
            $table->string("tell");
            $table->string("email");
            $table->string("address");
            $table->enum('gender',['1','2']);
            $table->tinyInteger('military')->default(0);
            $table->text('military_title')->nullable();
            $table->text('married_title')->nullable();
            $table->enum('condemnation',['0','1']);
            $table->enum('illness',['0','1']);
            $table->enum('work_type',['1','2','3','4']);
            $table->enum('work_evening',['0','1']);
            $table->enum('work_operant',['0','1']);
            $table->enum('work_cooperate',['1','2','3','4','5']);
            $table->enum('work_holidays',['0','1']);
            $table->enum('insurance_history',['0','1']);
            $table->text('work_insurance')->nullable();
            $table->text('insurance_number')->nullable();
            $table->text('work_salary');
            // $table->foreignId('organization_id')->nullable()->constrained("employment_organization")->cascadeOnUpdate()->nullOnDelete();
            // $table->foreignId('studdies_grade_id')->nullable()->constrained('employment_studdies_grade')->cascadeOnUpdate()->nullOnDelete();
            // $table->foreignId('language_id')->nullable()->constrained('employment_languages')->cascadeOnUpdate()->nullOnDelete();
            $table->enum("office",['1','2','3','4','5']);
            $table->enum("accounting",['1','2','3','4','5']);
            $table->enum("internet",['1','2','3','4','5']);
            $table->enum("socialmedia",['1','2','3','4','5']);
            $table->enum("designing",['1','2','3','4','5']);
            $table->enum("it",['1','2','3','4','5']);
            $table->string('computer_knowledge_note')->nullable();
            $table->text('computer_knowledge_note_more')->nullable();
            $table->string('reagent_name')->nullable();
            $table->string('reagent_job')->nullable();
            $table->string('reagent_relativity')->nullable();
            $table->string('reagent_year')->nullable();
            $table->string('reagent_mobile')->nullable();
            // $table->foreignId('cv_id')->nullable()->constrained('employment_cv')->cascadeOnUpdate()->nullOnDelete();
            $table->enum("state",["0","1","2"])->default("0");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employment_organization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employment_id')->nullable()->constrained('employments')->cascadeOnUpdate()->nullOnDelete();
            $table->string("name")->nullable();
            $table->string("last_side")->nullable();
            $table->string("cooperation_time")->nullable();
            $table->string("cooperation_end")->nullable();
            $table->string("cooperation_reason")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employment_studdies_grade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employment_id')->nullable()->constrained('employments')->cascadeOnUpdate()->nullOnDelete();
            $table->string("title")->nullable();
            $table->string("field_study")->nullable();
            $table->string("name_training")->nullable();
            $table->string("year_graduation")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employment_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employment_id')->nullable()->constrained('employments')->cascadeOnUpdate()->nullOnDelete();
            $table->string("title")->nullable();
            $table->enum("write",['1','2','3','4','5'])->nullable();
            $table->enum("read",['1','2','3','4','5'])->nullable();
            $table->enum("conversation",['1','2','3','4','5'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employment_cv', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employment_id')->nullable()->constrained('employments')->cascadeOnUpdate()->nullOnDelete();
            $table->string("file");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_organization');
        Schema::dropIfExists('employment_languages');
        Schema::dropIfExists('employment_studdies_grade');
        Schema::dropIfExists('employment_cv');
        Schema::dropIfExists('employments');
    }
};
