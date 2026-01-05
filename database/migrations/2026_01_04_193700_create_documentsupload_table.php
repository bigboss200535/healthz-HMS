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
        Schema::create('documents_upload', function (Blueprint $table) {
            $table->string('documents_id', 50)->primary();
            $table->string('patient_id', 50)->nullable();
            $table->string('opd_number')->nullable();
            $table->string('file_path', 300)->nullable();
            $table->string('file_name', 300)->nullable();
            $table->string('file_type', 300)->default('Other');
            $table->unsignedBigInteger('file_size');
            $table->string('document_type', 50)->nullable();
            $table->string('mime_type')->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 50)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();

            // keys
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('archived_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
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
        Schema::dropIfExists('documents_upload');
    }
};
