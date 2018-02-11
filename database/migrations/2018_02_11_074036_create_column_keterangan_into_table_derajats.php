<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnKeteranganIntoTableDerajats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('derajats', function (Blueprint $table) {
            $table->string('ket_rendah')->nullable();
            $table->string('ket_sedang')->nullable();
            $table->string('ket_tinggi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('derajats', function (Blueprint $table) {
            $table->dropColumn(['ket_rendah', 'ket_sedang', 'ket_tinggi']);
        });
    }
}
