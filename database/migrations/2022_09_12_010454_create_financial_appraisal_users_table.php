<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialAppraisalUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_appraisal_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class,'user_id' );
            $table->integer('reservations_count')->unsigned()->nullable();
            $table->string('reservation_type', 50)->nullable();
            $table->string('duration_type', 50)->nullable();
            $table->decimal('performance_result_1')->nullable();
            $table->decimal('performance_result')->nullable();
            $table->decimal('organization_result')->nullable();
            $table->decimal('result')->nullable();
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
        Schema::dropIfExists('financial_appraisal_users');
    }
}
