<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Super Admin',
            'username'  => 'superadmin',
            'email'     => 'superadmin@plesir.my.id',
            'password'  => Hash::make('password'),
            'role_name' => 'Super Admin',
            'users_id'  => 'SUPER' . Str::upper(Str::random(5)),
        ]);
        DB::table('users')->insert([
            'name'      => 'Admin Wisata',
            'username'  => 'adminwisata',
            'email'     => 'adminwisata@plesir.my.id',
            'password'  => Hash::make('password'),
            'role_name' => 'Admin Wisata',
            'users_id'  => 'ADMIN' . Str::upper(Str::random(5)),
        ]);
        DB::table('users')->insert([
            'name'      => 'Faizal Aji Wibowo',
            'username'  => 'faizalajiw',
            'email'     => 'faizalajiw@plesir.my.id',
            'password'  => Hash::make('password'),
            'role_name' => 'Pengguna',
            'users_id'  => 'USER' . Str::upper(Str::random(6)),
        ]);
    }
}
