<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('version_id')->nullable();
            $table->unsignedBigInteger('transmission_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('fuel_id')->nullable();
            $table->unsignedBigInteger('body_id')->nullable();

            $table->string('image')->nullable();
            $table->char('license_plate', 10);
            $table->boolean('state');
            $table->char('year');
            $table->integer('doors');
            $table->integer('negotiation');
            $table->decimal('km', 10, 3);
            $table->decimal('price', 10, 2)->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('offer')->nullable();
            
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('version_id')->references('id')->on('versions')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('transmission_id')->references('id')->on('transmissions')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('body_id')->references('id')->on('bodies')->onDelete('set null')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
