<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string('co2_emissions')->nullable();
            $table->string('urban_nonurban')->nullable();
            $table->string('euro_status')->nullable();
            $table->string('insurance_group')->nullable();
            $table->string('security')->nullable();
            $table->string('speed')->nullable();
            $table->string('top_speed')->nullable();
            $table->string('max_power')->nullable();
            $table->string('max_torque')->nullable();
            $table->string('valve_gear')->nullable();
            $table->string('cyl_arr')->nullable();
            $table->string('gears')->nullable();
            $table->string('aspiration')->nullable();
            $table->string('cylinders')->nullable();
            $table->string('drive_rear')->nullable();
            $table->string('length')->nullable();
            $table->string('breath')->nullable();
            $table->string('height')->nullable();
            $table->string('max_gross_weight')->nullable();
            $table->string('towing_weight_braked')->nullable();
            $table->string('towing_weight_unbraked')->nullable();
            $table->string('seats')->nullable();
            $table->string('adult')->nullable();
            $table->string('child')->nullable();
            $table->string('pedestrian')->nullable();
            $table->string('safety_assist')->nullable();
            $table->string('overall')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}
