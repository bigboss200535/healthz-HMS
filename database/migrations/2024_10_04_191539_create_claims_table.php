<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->string('claim_id', 50)->primary();
            $table->string('opd_number', 100)->nullable();
            $table->string('age', 10)->nullable();
            $table->string('pat_status', 10)->nullable();
            $table->date('attendance_date', 10)->nullable();
            $table->date('claim_start_date', 10)->nullable();
            $table->date('claims_end_date', 10)->nullable();
            $table->string('user_id', 10)->nullable();
            $table->string('no_of_visits', 10)->nullable();
            $table->string('sponsor_id', 10)->nullable();
            $table->string('attendance_type', 10)->nullable();
            $table->string('duration', 10)->nullable();
            $table->string('gdrg', 10)->nullable();
            $table->string('service_fee', 10)->nullable();
            // $table->string('episode_id', 10)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('episode_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
};
