<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
       Schema::create('patient_info', function (Blueprint $table) {
            $table->string('patient_id', 50)->primary();
            $table->string('title_id', 50);
            $table->string('firstname', 100);
            $table->string('middlename', 100);
            $table->string('lastname', 100);
            $table->string('fullname')->virtualAs("CONCAT(firstname, ' ', middlename, ' ', lastname)");
            $table->date('birth_date');
            $table->string('gender_id', 50)->nullable();
            $table->string('occupation_id', 50)->nullable();
            $table->string('education', 100)->nullable();
            $table->string('religion_id', 50)->nullable();
            $table->string('nationality_id', 50)->nullable();
            $table->string('ghana_card', 50)->nullable();
            $table->string('old_folder', 100)->nullable();
            $table->string('death_status', 100)->default('No');
            $table->date('death_status_date', 100)->nullable();
            $table->string('telephone', 50)->nullable()->index();
            $table->string('work_telephone', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('town', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('dependant', 50)->nullable();
            $table->string('email_verified', 20)->default('No');
            $table->string('telephone_verified', 20)->default('No');
            $table->string('allow_sms', 50)->default('No');
            $table->string('blood_group', 50)->nullable();
            $table->string('allow_email', 50)->default('No');
            $table->string('records_id', 100)->nullable();
            $table->string('opd_type', 50)->nullable();
            $table->date('register_date')->nullable()->default(DB::raw('CURRENT_DATE'));
            $table->string('user_id', 100)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // key
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('religion_id')->references('religion_id')->on('religion');
            $table->foreign('title_id')->references('title_id')->on('title');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('occupation_id')->references('occupation_id')->on('occupation');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('nationality_id')->references('nationality_id')->on('nationality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_info');
    }
};
