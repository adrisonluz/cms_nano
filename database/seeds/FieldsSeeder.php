<?php

use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cms_fields')->insert([
          'sitename' => 'Nome do site',
      ]);
    }
}
