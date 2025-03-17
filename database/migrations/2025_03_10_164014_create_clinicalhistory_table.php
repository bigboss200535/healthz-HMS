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
        Schema::create('clinical_history', function (Blueprint $table) {
            $table->string('clinical_history_id', 50)->primary();
            $table->string('history_item', 150)->nullable();
            $table->string('gender_id', 50)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 50)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 50)->default('Active')->index();
            $table->string('archived', 50)->default('No')->index();
            $table->string('archived_id', 50)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('age_id')->references('age_id')->on('ages');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinical_history');
    }
};
