<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAplEmailStatusFromMailgun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apl_email', function (Blueprint $table) {
            $table->string('status')->after('attachment')->nullable();
            $table->string('id_mailgun')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apl_email', function (Blueprint $table) {
            $table->dropColumn(['status','id_mailgun']);
        });
    }
}
