<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanierProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panier_produits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantite');
            $table->integer('panier_id')->unsigned();
            $table->foreign('panier_id')->references('id')->on('paniers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('produit_id')->unsigned();
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('panier_produits');
    }
}
