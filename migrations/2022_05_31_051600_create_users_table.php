<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('mobile', 11)->unique('mobile_idx')->comment('手机号');
            $table->string('username', 30)->comment('昵称');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->unsignedTinyInteger('gender')->default('0')->comment('性别[1:男 2:女 0:为止]');
            $table->string('password', 255)->comment('密码');
            $table->string('motto', 255)->default('')->comment('个人签名');
            $table->string('website', 255)->default('')->comment('个人站点');
            $table->string('email', 30)->default('')->comment('邮箱');
            $table->string('city', 30)->default('')->comment('城市');
            $table->unsignedTinyInteger('is_robot')->default('0')->comment('是否是机器人[0:不是 1:是]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
