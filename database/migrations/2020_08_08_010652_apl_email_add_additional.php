<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AplEmailAddAdditional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apl_email', function (Blueprint $table){
            $table->string('from')->after('id');
            $table->text('attachment')->after('body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apl_email', function (Blueprint $table){
            $table->dropColumn(['from', 'attachment']);
        });
    }
}
