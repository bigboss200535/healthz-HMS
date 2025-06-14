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
        Schema::create('product_prices', function (Blueprint $table) {
                $table->string('product_id', 50)->nullable();
                $table->double('unit_cost', 10,2);
                $table->double('cash_price', 10,2)->nullable();
                $table->double('cooperate_price', 10,2)->nullable();
                $table->double('private_insurance_price', 10,2)->nullable();
                $table->double('nhis_amount', 10,2)->nullable();
                $table->double('nhis_topup', 10,2)->nullable();
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
                $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prices');
    }
};
