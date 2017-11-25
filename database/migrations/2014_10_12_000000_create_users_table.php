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
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('fld_Id');
            $table->string('fld_Username')->unique();
            $table->string('fld_Name');
            $table->string('fld_Password');
            $table->string('fld_Ip')->nullable();
            $table->string('fld_Browser')->nullable();
            $table->dateTime('fld_Last_Login')->nullable(); 
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
        Schema::dropIfExists('users');
    }
}
