<?php

use Illuminate\Database\Seeder;

class GaleriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galerias')->insert([
            'sitename' => 'Nome do site',
        ]);
    }
}
