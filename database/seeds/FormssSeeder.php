<?php

use Illuminate\Database\Seeder;

class FormssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_forms')->insert([
            'sitename' => 'Nome do site',
        ]);
    }
}
