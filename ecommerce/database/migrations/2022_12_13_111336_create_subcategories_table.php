<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name')->unique();
            $table->string('slug');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
};
