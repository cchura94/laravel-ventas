<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            //$table->string("idped", 10);
            $table->dateTime("fecha_pedido");
            $table->integer("nro")->nullable();
            $table->integer("estado")->default(0); // 1: en proceso, 2: completado 3: pendiente 4: cancelado
            $table->decimal("monto_total", 10, 2)->defaul(0);
            $table->bigInteger("cliente_id")->unsigned();
            // relacion 1 a muchos
            $table->foreign("cliente_id")->references("id")->on("clientes");
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
        Schema::dropIfExists('pedidos');
    }
}
