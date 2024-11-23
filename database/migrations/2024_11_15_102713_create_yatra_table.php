<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYatraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yatra', function (Blueprint $table) {
            $table->id();
			$table->bigInteger("yatrik_id");
			$table->foreign("yatrik_id")->references("id")->on("yatriks");
			$table->integer("event_id");
			$table->foreign("event_id")->references("id")->on("events");
			$table->integer("day_id");
			$table->foreign("day_id")->references("id")->on("days");
			$table->boolean('is_allowed')->default('1');
			$table->boolean('attendance')->default('0');
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
        Schema::dropIfExists('yatra');
    }
}
