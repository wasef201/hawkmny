<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionRemainsCountReviewStanderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_standards', function (Blueprint $table) {
            $table->integer('total_standard_questions')->nullable();
            $table->integer('answered_question_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */

    public function down()
    {
        Schema::table('review_standards', function (Blueprint $table) {
            $table->dropColumn('total_standard_questions');
            $table->dropColumn('answered_question_count');
        });
    }
}
