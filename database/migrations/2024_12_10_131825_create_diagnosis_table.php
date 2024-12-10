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
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->string('diagnosis_id', 50);
            $table->string('diagnosis_code', 150)->nullable();
            $table->string('diagnosis', 200)->nullable();
            $table->string('class', 50)->nullable();
            $table->string('class_id', 50)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('icd_10', 50)->nullable();
            $table->string('icd_group_id', 50)->nullable();
            $table->string('gdrg_code', 50)->nullable();
            $table->string('gdrg_description', 150)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('gender_id', 50)->nullable();
            $table->string('is_chronic', 50)->nullable()->default('No');
            $table->string('is_nhis', 50)->nullable();
            $table->string('adult_tarif', 50)->nullable();
            $table->string('child_tarif', 50)->nullable();
            $table->string('gdrg_adult', 50)->nullable();
            $table->string('gdrg_child', 50)->nullable();
            $table->string('is_active', 50)->nullable();
            $table->string('user_id', 10)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->primary('diagnosis_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            // $table->foreign('gender_id')->references('gender_id')->on('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosis');
    }
};
