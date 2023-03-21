<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_murids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('murid_id')->unsigned();
            $table->foreign('murid_id')->references('id')->on('murids')->onDelete('cascade');
            $table->timestamp('absen_hadir')->nullable();
            $table->timestamp('absen_pulang')->nullable();
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
        Schema::dropIfExists('absensi_murids');
    }
};
