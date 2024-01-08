<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeReviewTableStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('standard_id');
            $table->dropColumn('field_id')->nullable();
            $table->dropColumn('practice_id')->nullable();
            $table->dropColumn('question_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('standard_id');
            $table->unsignedBigInteger('field_id')->nullable();
            $table->unsignedBigInteger('practice_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
        });
    }
}
