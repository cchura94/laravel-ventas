<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /*protected $primaryKey = "idped";
    protected $typeKey = "string";
    protected $incrementig = false;*/

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }

    public function productos()
    {
        return $this->belongsToMany("App\Models\Producto");
    }
}
