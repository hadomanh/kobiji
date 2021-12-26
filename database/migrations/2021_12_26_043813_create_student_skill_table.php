<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_skill', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['student_id', 'skill_id']);
            $table->double('grade')->default(-1);
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
        Schema::dropIfExists('student_skill');
    }
}
