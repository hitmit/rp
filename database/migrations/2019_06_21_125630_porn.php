<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Porn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porn', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('title')->nullable();
            $table->string('date_added')->nullable();
            $table->text('url')->nullable();
            $table->Integer('duration')->default(0);
            $table->string('username')->nullable();
            $table->text('embed')->nullable();
        });

        Schema::create('tags', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });

        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });

        Schema::create('porn_tags', function(Blueprint $table) {
            $table->integer('porn_id')->unsigned();
            $table->foreign('porn_id')->references('id')->on('porn')
                ->onUpdate('cascade');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onUpdate('cascade');
        });

        Schema::create('porn_categories', function(Blueprint $table) {
            $table->integer('porn_id')->unsigned();
            $table->foreign('porn_id')->references('id')->on('porn')
                ->onUpdate('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade');
        });

        Schema::create('porn_thumbs', function(Blueprint $table) {
            $table->integer('porn_id')->unsigned();
            $table->foreign('porn_id')->references('id')->on('porn')
                ->onUpdate('cascade');
            $table->string('thumb');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('porn_thumbs');
        Schema::drop('porn_categories');
        Schema::drop('porn_tags');
        Schema::drop('categories');
        Schema::drop('tags');
        Schema::drop('porn');
    }
}
