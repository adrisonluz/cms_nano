<?php

use Illuminate\Database\Seeder;

class AgendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('agenda')->insert([
          'sitename' => 'Nome do site',
      ]);
    }
}
