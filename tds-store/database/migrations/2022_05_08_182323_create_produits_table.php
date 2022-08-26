<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('description');
            $table->string('slug')->unique();
            $table->integer('quantite');
            $table->decimal('prix', 10, 2);
            $table->integer('sous_categorie_id')->unsigned();
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories');
            $table->decimal('prix_achat', 10, 2)->nullable();
            $table->decimal('prix_vente_500000', 10, 2)->nullable();
            $table->decimal('prix_vente_1000000',10, 2)->nullable();
            $table->decimal('prix_vente_5000000',10, 2)->nullable();
            $table->decimal('prix_vente_10000000',10, 2)->nullable();
            $table->decimal('prix_vente_10000000_+',10, 2)->nullable();
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
        Schema::dropIfExists('produits');
    }
}
