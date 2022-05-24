<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_students', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->string('last_name');
			$table->string('phone')->default(null);
            $table->string('email')->default(null);
            $table->string('photo')->default(null);
            $table->integer('registration_fee')->default(null);
            $table->date('register_date')->default(null);
            $table->integer('user_id');
            $table->integer('is_active')->default('1');
            $table->integer('has_discount')->default('0');;
            $table->integer('register_discount')->default(null);;
            $table->integer('enrol_discount')->default(null);;
            $table->integer('use_fitness_devices')->default(0);;
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
        Schema::dropIfExists('students');
    }
}
