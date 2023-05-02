<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //  parent_mobile_no, parent_email_id, student_photo, student year group, record added by

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name', 100);
            $table->integer('age');
            $table->date('date_of_birth');
            $table->string('address', 255);
            $table->integer('parent_mobile_no');
            $table->string('parent_email_id', 255);
            $table->string('student_photo', 200);
            $table->string('student_year_group', 255);
            $table->string('Record added by', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
