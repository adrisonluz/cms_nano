<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categorias')->insert([
          'sitename' => 'Nome do site',
      ]);
    }
}
