<?php

use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cms_menus')->insert([
          'sitename' => 'Nome do site',
      ]);
    }
}
