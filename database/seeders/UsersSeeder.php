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
            'email'     => 'cs.plesirtegal@gmail.com',
            'password'  => Hash::make('password'),
            'role_name' => 'Super Admin',
            'status'    => 'Aktif',
            'users_id'  => 'SUPER' . Str::upper(Str::random(5)),
        ]);
        DB::table('users')->insert([
            'name'      => 'Admin Wisata',
            'username'  => 'adminwisata',
            'email'     => 'faizalajiwibowo7@gmail.com',
            'password'  => Hash::make('password'),
            'role_name' => 'Admin Wisata',
            'status'    => 'Pending',
            'users_id'  => 'ADMIN' . Str::upper(Str::random(5)),
        ]);
        DB::table('users')->insert([
            'name'      => 'Faizal Aji Wibowo',
            'username'  => 'faizalajiw',
            'email'     => 'faizalajiwibowo9@gmail.com',
            'password'  => Hash::make('password'),
            'role_name' => 'Pengguna',
            'status'    => 'Aktif',
            'users_id'  => 'USER' . Str::upper(Str::random(6)),
        ]);
    }
}
