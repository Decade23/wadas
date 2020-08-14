<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldAplMailFromAplMail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apl_email', function (Blueprint $table) {
            $table->dropColumn('recipient');
        });

        Schema::table('apl_email', function (Blueprint $table) {
            $table->string('recipient')->after('id')->nullable();
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
            $table->dropColumn('recipient');
        });

        Schema::table('apl_email', function (Blueprint $table) {
            $table->string('recipient')->after('id');
        });
    }
}
