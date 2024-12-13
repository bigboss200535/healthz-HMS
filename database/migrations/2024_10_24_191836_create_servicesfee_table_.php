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
        Schema::create('services_fee', function (Blueprint $table) {
            $table->string('service_fee_id', 50);
            $table->string('service_id', 100);
            $table->string('service', 100);
            $table->string('service_type_code', 100);
            $table->float('cash_amount')->nullable();
            $table->float('private_amount')->nullable();
            $table->float('company_amount')->nullable();
            $table->float('foreigners_amount')->nullable();
            $table->float('nhis_adult', 8,2)->nullable();
            $table->float('nhis_child')->nullable();
            $table->string('allow_nhis', 100)->nullable();
            $table->string('gdrg_adult', 100)->nullable();
            $table->string('gdrg_child', 100)->nullable();
            $table->string('allow_topup', 100)->nullable();
            $table->decimal('topup_amount', 10,2)->nullable()->default('0');
            $table->string('editable', 100)->nullable();
            $table->string('delivery_mode', 100)->nullable(); //internal or external
            $table->string('gender_id', 50)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('patient_type', 50)->nullable(); //in, out, all
            $table->string('is_active', 50)->nullable(); //yes, no,
            $table->string('facility_id', 50)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->primary('service_fee_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('service_id')->references('service_id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_fee');
    }
};
