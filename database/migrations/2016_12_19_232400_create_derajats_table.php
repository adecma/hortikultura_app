<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDerajatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derajats', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('rendah', 6, 2);
            $table->decimal('sedang', 6, 2);
            $table->decimal('tinggi', 6, 2);
            $table->integer('variable_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('derajats');
    }
}
