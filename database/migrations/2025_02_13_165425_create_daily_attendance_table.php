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
        Schema::create('newwwww', function (Blueprint $table) {
            $table->id('attendance_id', 50);
            $table->timestamp('added_date')->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('patient_id', 100)->nullable();
            $table->string('facility_id', 100)->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->timestamp('archived_date')->nullable();

            // Foreign key constraint
            // $table->foreign('user_id')->references('user_id')->on('users');
            // $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            // $table->foreign('facility_id')->references('facility_id')->on('facility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newwwww');
    }
};
