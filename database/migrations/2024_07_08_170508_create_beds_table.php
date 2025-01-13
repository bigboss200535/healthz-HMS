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
        Schema::create('admission_beds', function (Blueprint $table) {
            $table->string('bed_id',50)->primary();
            $table->string('bed_number',150); 
            $table->string('bed_status', 50)->default('Non-Operational');
            $table->string('ward_id',150)->nullable(); 
            $table->string('bed_condition',150)->default('Free');//free or occupaid 
            $table->string('bed_type',150)->default('Real');//real or virtual 
            $table->string('admission_record',150)->nullable();
            $table->string('admission_opd_no',150)->nullable();
            $table->string('facility_id', 50)->nullable(); 
            $table->string('user_id',50);        
            $table->string('added_id', 50)->nullable();
            $table->string('added_by', 100)->nullable();
            $table->date('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->date('updated_date')->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('archived', 100)->default('No');
            $table->date('archived_date')->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('ward_id')->references('ward_id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_beds');
    }
};
