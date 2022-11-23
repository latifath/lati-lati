<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adresse_livraison_id')->unsigned();
            $table->foreign('adresse_livraison_id')->references('id')->on('adresse_livraisons')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('adresse_client_id')->unsigned();
            $table->foreign('adresse_client_id')->references('id')->on('adresse_clients')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('invoice_id')->default(0);
            $table->string('status')->default('en cours');
            $table->decimal('tva', 3, 2)->nullable();
            $table->string('promotion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
