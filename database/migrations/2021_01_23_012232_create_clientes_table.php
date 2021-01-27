<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombres", 30);
            $table->string("apellidos", 30);
            $table->string("ci_nit", 15)->default(0);
            $table->string("telefono", 15)->nullable();
            $table->string("direccion", 200)->nullable();
            $table->bigInteger("user_id")->unsigned()->nullable();

            // Relacion Uno a Uno
            $table->foreign("user_id")->references("id")->on("users");

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
        Schema::dropIfExists('clientes');
    }
}
