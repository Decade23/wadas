<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAplEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apl_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recipient');
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->string('title');
            $table->mediumText('body');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('apl_email');
    }
}
