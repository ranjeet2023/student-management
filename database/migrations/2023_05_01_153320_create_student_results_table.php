<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // student_id, maths, science, english, gujarati, computer, exam_year, obtained marks, total marks, percentage, percentile, record added by

    public function up(): void
    {
        Schema::create('student_results', function (Blueprint $table) {
            $table->id('student_id');
            $table->integer('maths');
            $table->integer('science');
            $table->integer('english');
            $table->integer('gujarati');
            $table->integer('computer');
            $table->integer('exam_year');
            $table->integer('obtained_marks');
            $table->integer('total_marks');
            $table->integer('percentage');
            $table->integer('percentile');
            $table->string('record_added_by',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_results');
    }
};
