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
            $table->integer('calories');
            $table->integer('protein');
            $table->integer('carbs');
            $table->integer('fat');
            $table->string('code');
            $table->string('img_url')->default('https://www.marketingmuses.com/wp-content/uploads/2018/01/invis-user.png');
            $table->integer('weight');
            $table->integer('height');
            $table->integer('target');
            $table->integer('age');
            $table->double('activity');
            $table->string("gender");
            $table->boolean('isconfirm')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
