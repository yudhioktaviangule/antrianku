<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antris', function (Blueprint $table) {
            $table->id();
            $table->string("nomor");
            $table->integer("pasien_id");
            $table->string("keperluan");
            $table->integer("diproses_oleh")->default(0);
            $table->enum("status",[0,1,2])->default(0);
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
        Schema::dropIfExists('antris');
    }
}
