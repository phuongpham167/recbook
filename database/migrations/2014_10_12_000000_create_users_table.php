<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('group_id');
            $table->integer('department_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('branch_id');
            $table->string('api_token', 60)->unique()->nullable();
            $table->timestamp('birthday')->nullable();
            $table->integer('identity')->nullable();
            $table->string('placeofissue')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('taxcode')->nullable();
            $table->string('address')->nullable();
            $table->integer('web_id')->default('1');
            $table->integer('company_name');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
