<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['student_id', 'subject_id']);
            $table->double('midterm')->default(-1);
            $table->double('endterm')->default(-1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_subject');
    }
}
