<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_users')->insert([
            'name' => 'Usuario Teste',
            'email' => 'teste@teste.com',
            'password' => bcrypt('teste1234'),
        ]);
    }
}
