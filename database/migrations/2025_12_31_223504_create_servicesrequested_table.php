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
        Schema::create('patient_services_requested', function (Blueprint $table) {
            $table->string('service_request_id', 50);
            $table->string('patient_id', 50);
            $table->string('opd_number', 50)->nullable()->index();
            $table->string('service_fee_id', 50);
            $table->string('attendance_id', 50);
            $table->string('service_id', 50);
            $table->string('sponsor_id', 50);
            $table->string('sponsor_type_id', 50);
            $table->string('service_type_id', 50);
            $table->float('cash_amount')->nullable();
            $table->float('private_amount')->nullable();
            $table->float('company_amount')->nullable();
            $table->float('foreigners_amount')->nullable();
           
            $table->string('gdrg_code', 100)->nullable();
            $table->string('allow_topup', 100)->nullable();
            $table->decimal('topup_amount', 10,2)->nullable()->default('0');
            $table->string('gender_id', 50)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('status_code', 50)->nullable(); //IN, OUT, ALL
            $table->date('attendance_date', 50)->nullable(); 
            $table->string('user_id', 100)->nullable();
            $table->string('facility_id')->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // $table->timestamps();

            // keys
            $table->foreign('user_id')->references('user_id')->on('users');
            // $table->foreign('added_id')->references('user_id')->on('users');
            $table->foreign('archived_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('age_id')->references('age_id')->on('ages');
            // $table->foreign('age_group_id')->references('age_group_id')->on('age_groups');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('sponsor_type_id')->references('sponsor_type_id')->on('sponsor_type');
            $table->foreign('attendance_id')->references('attendance_id')->on('patient_attendance');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_services_requested');
    }
};
