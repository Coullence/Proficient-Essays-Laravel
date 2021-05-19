<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Files extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->unsigned()->index();
            $table->unsignedBigInteger('revision_order_id')->nullable()->unsigned()->index();
            $table->string('fileName')->nullable();
            $table->string('Status')->default('New');
            $table->timestamps();
            $table->softDeletes();

            //Relationships
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Files');
    }
}

