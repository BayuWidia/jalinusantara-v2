<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fullname');
            $table->string('email', 250);
            $table->string('password');
            $table->string('url_foto');
            $table->integer('login_count')->nullable()->default(1);
            $table->integer('id_role');
            //0:belum aktif, 1:sudah aktif
            $table->integer('activated')->default(1);
            $table->string('created_by');
            $table->string('updated_by');
            $table->rememberToken();
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
        // Schema::dropIfExists('master_users');
    }
}
