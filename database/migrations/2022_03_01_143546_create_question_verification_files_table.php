<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionVerificationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_verification_files', function (Blueprint $table) {
            $table->id();
            $table->integer('review_id');
            $table->text('file');
            $table->text('file_name');
            $table->integer('user_id');
            $table->integer('question_verification_id');
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
        Schema::dropIfExists('question_verification_files');
    }
}
