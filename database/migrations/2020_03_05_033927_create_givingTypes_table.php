<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGivingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giving_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('amount');
            $table->string('min_amount');
            $table->string('max_amount');
            $table->integer('target_number');
            $table->string('description');
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
        Schema::dropIfExists('giving_types');
    }
}
