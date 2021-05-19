<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('OUID')->unique();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('topic')->default('No Topic');
            $table->string('question')->default('No Question');
            $table->longtext('instructions')->default('No instructions');
            $table->string('pages');
            $table->string('format')->default('No Given');
            $table->string('duration')->nullable();
            $table->float('pricing')->default('10.00');
            $table->timestamp('due');
            $table->ipAddress('order_ip_address')->nullable();
            $table->ipAddress('admin_ip_address')->nullable();
            $table->ipAddress('updated_ip_address')->nullable();
            $table->ipAddress('deleted_ip_address')->nullable();
            $table->string('status')->default('New');
            $table->timestamps();
            $table->softDeletes();

            //Relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
