<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('gso_id');
            $table->unsignedBigInteger('district_id');
            $table->timestamps();

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->cascadeOnDelete()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wards');
    }
}
