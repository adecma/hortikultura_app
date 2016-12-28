<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHortikulturaVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hortikultura_variable', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hortikultura_id')->unsigned();
            $table->integer('variable_id')->unsigned();
            $table->decimal('nilai', 6, 2)->nullable();

            $table->foreign('hortikultura_id')
                ->references('id')->on('hortikulturas')
                ->onDelete('cascade');
            $table->foreign('variable_id')
                ->references('id')->on('variables')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hortikultura_variable');
    }
}
