<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('choices', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->double('percentage')->default(0)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verify')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
}
