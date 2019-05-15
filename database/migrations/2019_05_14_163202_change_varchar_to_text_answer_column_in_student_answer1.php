<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVarcharToTextAnswerColumnInStudentAnswer1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_answers', function (Blueprint $table) {
            //
            $table->text('answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_answers', function (Blueprint $table) {
            //
            $table->dropColumn('answer');
        });
    }
}
