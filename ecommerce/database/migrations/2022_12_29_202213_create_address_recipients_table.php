<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('address_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained();
            $table->integer('provinces');
            $table->integer('districts');
            $table->integer('wards');
            $table->text('street');
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('address_recipients');
    }
};
