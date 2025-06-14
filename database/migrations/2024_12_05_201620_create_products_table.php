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
        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id', 50)->primary();
            $table->string('product_name', 150)->nullable();
            $table->string('default_method', 50)->nullable();
            $table->string('prescription_qty', 10)->nullable();
            $table->string('store_id', 50)->nullable();
            $table->string('product_class_id', 50)->nullable();
            $table->string('product_class', 50)->nullable();
            $table->string('manufacturer', 50)->nullable();
            $table->string('nhis_id', 50)->nullable();
            $table->string('nhis_cover', 50)->nullable()->default('No');
            $table->string('expirable', 50)->nullable()->default('No');
            $table->string('product_type', 50)->nullable()->default('Drug');// drug, consumable, stationaries
            $table->string('is_stockable', 50)->nullable()->default('No');
            $table->string('short_presentation', 50)->nullable();// tab, cap, course, pack, supp, inj
            $table->string('presentation', 50)->nullable();
            $table->string('pres_quanity_per_issue_unit', 50)->nullable();
            $table->string('pres_unit_quantity', 50)->nullable();
            $table->string('base_unit', 50)->nullable();
            $table->string('unit_base', 50)->nullable();
            $table->string('gender_id', 50)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('prescription_level', 50)->nullable();
            $table->string('product_type_id', 50)->nullable();
            $table->float('average_unit_price')->nullable();
            $table->string('pres_unit_code')->nullable();
            $table->string('pres_qty_per_unit')->nullable();
            $table->string('pres_qty_per_issue_unit')->nullable();
            $table->string('patient_type')->nullable();
            $table->string('allow_copay')->nullable();
            $table->string('check_prescriped_qty')->nullable()->default('No');
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
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('store_id')->references('store_id')->on('stores');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('age_id')->references('age_id')->on('ages');
            $table->foreign('product_class_id')->references('product_class_id')->on('product_class');
            $table->foreign('product_type_id')->references('product_type_id')->on('product_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
