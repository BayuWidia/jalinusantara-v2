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
            $table->string('name')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email', 250)->nullable();
            $table->string('password')->nullable();
            $table->string('url_foto')->nullable();
            $table->integer('login_count')->nullable()->default(1);
            $table->integer('id_role')->nullable();
            //0:belum aktif, 1:sudah aktif
            $table->integer('activated')->nullable()->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
