<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('subcategory_id')->constrained();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_quantity');
            $table->string('product_tags')->nullable(); 
            $table->string('product_size')->nullable(); 
            $table->string('product_color')->nullable(); 
            $table->string('price');
            $table->string('discount')->nullable(); 
            $table->string('short_desciption');
            $table->text('long_desciption')->nullable(); 
            $table->integer('product_thumbnail')->nullable(); 
            $table->integer('vendor_id');
            $table->integer('hot_deals')->nullable(); 
            $table->integer('status')->default(0); 
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
