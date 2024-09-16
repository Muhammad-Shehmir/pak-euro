<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->date('date');
            $table->string('shipper_name');
            $table->string('marks_and_numbers');
            $table->string('bl_no');
            $table->string('vessel_voy');
            $table->string('bags');
            $table->string('delivery_city');
            $table->string('hcl');
            $table->integer('imcont_no');
            $table->integer('expc_no');
            $table->date('landing_date');
            $table->string('eway_bill');
            $table->decimal('rtgs_amount', 10, 2)->nullable();
            $table->string('delivery_status');
            $table->string('vehicle_and_driver');
            $table->text('delivery_address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
