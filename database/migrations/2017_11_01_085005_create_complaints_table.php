<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_complaints', function (Blueprint $table) {
            $table->increments('fld_Id');
            $table->integer('fld_Subject')->index();
            $table->string('fld_Consignment',17);
            $table->longText('fld_Description')->nullable();
            $table->integer('fld_Registrar');
            $table->integer('fld_User')->index();
            $table->text('fld_User_Name');
            $table->integer('fld_Level');
            $table->boolean('fld_Suspend')->default(false);
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
        Schema::dropIfExists('tbl_complaints');
    }
}
