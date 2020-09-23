<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCmsPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_posts', function (Blueprint $table){
            $table->char('visibility', 10)->after('counter')->default('publish');
            $table->string('updated_by')->after('written_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_posts', function (Blueprint $table){
            $table->dropColumn(['updated_by','visibility']);
        });
    }
}
