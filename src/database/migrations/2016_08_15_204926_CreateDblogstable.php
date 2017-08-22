<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildlogtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildlog', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('table',100);
            $table->integer('user_id');
            $table->string('user_name',100);
            $table->biginteger('rows_key');
            $table->string('event',20);
            $table->text('original');
            $table->text('after');
            $table->text('query');
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
        Schema::drop('buildlog');
    }
}
