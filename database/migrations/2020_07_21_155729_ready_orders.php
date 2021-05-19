<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReadyOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ReadyOrders', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('OUID');
            $table->string('email');
            $table->string('note')->nullable();
            $table->string('fileName')->nullable();
            $table->string('Status')->default('New');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ReadyOrders');
    }
}

