<?php namespace Kodermax\CallBack\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateRequestsTable extends Migration
{

    public function up()
    {
        Schema::create('kodermax_callback_requests', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kodermax_callback_requests');
    }

}
