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
            $table->string('age', 20)->nullable();
            $table->string('attendance_id', 50)->nullable();
            $table->date('birth_date');
            $table->string('pat_status', 10)->nullable();
            $table->date('attendance_date')->nullable();
            $table->date('claims_end_date')->nullable();
            $table->date('claim_start_date')->nullable();
            $table->date('claim_month')->nullable();
            $table->date('claim_year')->nullable();
           
            $table->string('user_id', 50)->nullable();
            $table->string('no_of_visits', 10)->nullable();
            $table->string('sponsor_id', 10)->nullable();
            $table->string('attendance_type', 10)->nullable();
            $table->string('duration', 10)->nullable();
            $table->string('gdrg', 10)->nullable();
            $table->string('has_pharmacy', 10)->nullable()->default('0');
            $table->string('has_procedure', 10)->nullable()->default('0');
            $table->float('service_fee', 10,2)->nullable();
            $table->float('pharmacy_fee', 10,2)->nullable();
            $table->float('total_claims', 10,2)->nullable();
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
            // key
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
