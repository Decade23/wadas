<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comment_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->unsignedInteger('cms_post_id');
            $table->string('comment');
            $table->char('status', 20)->default('pending'); // approved, pending
            $table->timestamps();

            $table->foreign('comment_id')->references('id')->on('cms_comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cms_post_id')->references('id')->on('cms_posts')->onDelete('cascade')->onUpdate('cascade');

            $table->index(['email','name','comment']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_comments');
    }
}
