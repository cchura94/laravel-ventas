<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $r1 = new Role;
        $r1->nombre = "admin";
        $r1->save();

        $r2 = new Role;
        $r2->nombre = "gerente";
        $r2->save();

        $r3 = new Role;
        $r3->nombre = "cajero";
        $r3->save();

        $u1 = new User;
        $u1->usuario = "admin";
        $u1->clave = bcrypt("admin12345");
        $u1->save();
        $u1->roles()->attach($r1);

        $u2 = new User;
        $u2->usuario = "gerente";
        $u2->clave = bcrypt("gerente12345");
        $u2->save();
        $u2->roles()->attach($r2);

        $u2 = new User;
        $u2->usuario = "cajero";
        $u2->clave = bcrypt("cajero12345");
        $u2->save();
        $u2->roles()->attach($r3);
    }
}
