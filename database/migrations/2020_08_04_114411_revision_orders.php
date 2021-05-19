<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RevisionOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RevisionOrders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('OUID')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->index()->nullable();
            $table->unsignedBigInteger('order_id')->unsigned()->index()->nullable();
            $table->longtext('revisionReason')->default('No instructions');
            $table->string('status')->default('New');
            $table->timestamps();
            $table->softDeletes();

            //Relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('RevisionOrders');
    }
}
