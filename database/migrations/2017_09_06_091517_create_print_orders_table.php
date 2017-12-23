<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_orders', function (Blueprint $table) {
            $table->string('batch_id');
            $table->integer('order_id');
            $table->integer('zdm01');
            $table->integer('zdm02');
            $table->integer('zdm03');
            $table->integer('zdm04');
            $table->boolean('status');
            $table->boolean('sales_exec');
            $table->boolean('dist_manager');
            $table->boolean('dc');
            $table->boolean('finance');
            $table->timestamps();
            $table->primary((array('batch_id', 'order_id')));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_orders');
    }
}
