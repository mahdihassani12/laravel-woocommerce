<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gym_name')->default(null);
            $table->string('phone')->default(null);
            $table->text('address')->default(null);
            $table->string('gym_logo')->default(null);
            $table->string('direction');
            $table->double('monthly_fee')->default(null);
            $table->double('register_fee')->default(null);
            $table->double('device_fee')->default(null);
            $table->string('date_type');
            $table->integer('user_id');
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
        Schema::dropIfExists('setting');
    }
}
