<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lesson', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['student_id', 'lesson_id']);
            $table->string('status')->default('出席');
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
        Schema::dropIfExists('student_lesson');
    }
}
