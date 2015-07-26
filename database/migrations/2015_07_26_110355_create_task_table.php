<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function ($table) {
    		$table->increments('id');
    		$table->string('name', 500);
    		$table->dateTime('due_date');
    		$table->boolean('completed');
    		$table->index(['due_date', 'completed']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task');
    }
}
