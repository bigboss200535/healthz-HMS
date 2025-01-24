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
        Schema::create('patient_sponsorship', function (Blueprint $table) {
            $table->string('patient_id', 50);
            $table->string('opd_number', 20)->nullable();
            $table->string('member_no', 150);
            $table->string('sponsor_id', 50)->nullable();
            $table->string('sponsor_type_id', 50)->nullable();
            $table->string('card_serial', 50)->nullable();
            $table->date('start_date', 100)->nullable();
            $table->date('end_date', 100)->nullable();
            $table->string('dependant', 50)->default('0');
            $table->string('records_id', 100)->nullable();
            $table->string('priority', 100)->nullable();
            $table->string('facility_id', 50)->nullable(); 
            $table->string('is_active', 100)->default('Yes');
            $table->string('user_id', 100)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('archived', 100)->default('No');
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('sponsor_type_id')->references('sponsor_type_id')->on('sponsor_type');
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
        Schema::dropIfExists('patient_sponsorship');
    }
};
