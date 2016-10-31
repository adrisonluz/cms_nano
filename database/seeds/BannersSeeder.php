<?php

use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cms_banners')->insert([
          'sitename' => 'Nome do site',
      ]);
    }
}
