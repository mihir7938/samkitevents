<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYatriksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yatriks', function (Blueprint $table) {
            $table->id();
			$table->integer("member_id");
			$table->integer("event_id");
			$table->foreign("event_id")->references("id")->on("events");
			$table->string('name');
			$table->string('gender', 20);
			$table->integer('age');
			$table->string('aadhar_number');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('country');
			$table->string('religious_method');
			$table->string('father_husband_name');
			$table->string('reference');
			$table->string('mobile_number');
			$table->string('other_number');
			$table->string('illness');
			$table->boolean('99_yatra');
			$table->boolean('12_gaon_chari_palit_sangh_yatra');
			$table->string('present_penance');
			$table->string('profile_photo');
			$table->string('qr_code');
			$table->bigInteger("created_by")->unsigned();
            $table->bigInteger("updated_by")->unsigned();
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
        Schema::dropIfExists('yatriks');
    }
}
