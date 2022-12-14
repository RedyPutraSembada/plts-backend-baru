<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bprs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->foreignId('login_id')->constrained();
            $table->foreignId('lokasi_id')->constrained();
            $table->string('nik', 16);
            $table->string('jenis_kelamin');
            $table->string('nip');
            $table->string('no_hp');
            $table->string('alamat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bprs');
    }
}
