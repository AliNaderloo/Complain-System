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
            $table->longText('fld_Description');
            $table->integer('fld_Level');
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
