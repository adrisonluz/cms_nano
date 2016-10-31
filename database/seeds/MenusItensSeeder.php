<?php

use Illuminate\Database\Seeder;

class MenusItensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cms_menus_itens')->insert([
          'sitename' => 'Nome do site',
      ]);
    }
}
