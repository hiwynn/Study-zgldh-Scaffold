<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique()->comment('名称');
            $table->text('description')->nullable()->comment('描述');
            $table->string('phone_number')->unique()->comment('号码');
            $table->integer('status')->nullable()->default(1)->comment('状态');
            $table->integer('find_counts')->nullable()->default(0)->comment('查找次数');
            $table->integer('added_by')->unsigned()->nullable()->comment('创建者');
            $table->integer('updated_by')->unsigned()->nullable()->comment('更新者');
            $table->softDeletes('deleted_at');
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
        Schema::drop('phone_list');
    }
}
