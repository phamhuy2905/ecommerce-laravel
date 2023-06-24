<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->smallInteger('status')->comment('ShipStatusEnum')->index();
            $table->string('name_recipient');
            $table->string('phone_recipient');
            $table->string('description_infomation')->nullable();
            $table->float('total')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('receive at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
