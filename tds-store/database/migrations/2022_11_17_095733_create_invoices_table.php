<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('date_paid')->nullable();
            $table->dateTime('date_cancel')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->integer('tva')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('payment_method')->nullable();
            $table->string('reference')->unique()->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('normalize')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *'id
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
