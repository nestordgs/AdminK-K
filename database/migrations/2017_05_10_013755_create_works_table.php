<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->decimal('direct_cost',12,2)->nullable(false);
            $table->decimal('admin_cost',12,2)->nullable(false)->comment('direct_cost * 10%');
            $table->decimal('utility',12,2)->nullable(false)->comment('direct_cost * 30%');
            $table->integer('type_work_id')->unsigned();
            $table->foreign('type_work_id')->references('id')->on('type_works');
            $table->integer('unit_of_measure_id')->unsigned();
            $table->foreign('unit_of_measure_id')->references('id')->on('unit_of_measure');
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
        Schema::dropIfExists('works');
    }
}
