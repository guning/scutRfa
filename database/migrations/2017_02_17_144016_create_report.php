<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->comment = '报道表';
            $table->increments('id');
            $table->char('title', 60)->comment('标题');
            $table->string('abstract', 150)->comment('简介');
            $table->integer('create_time')->comment('创建时间戳');
            $table->integer('update_time')->comment('更新时间戳');
            $table->string('html_url')->comment('html文件地址');
            $table->string('surface_plot_url')->comment('标题图文件地址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('report');
    }
}
