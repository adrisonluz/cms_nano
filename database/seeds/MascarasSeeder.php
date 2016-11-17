<?php

use Illuminate\Database\Seeder;

class MascarasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_mascaras')->insert([
            'id' => 1,
            'nome' => 'Telefone',
            'mask' => '(99) [9]9999-9999'
        ]);

        DB::table('cms_mascaras')->insert([
            'id' => 2,
            'nome' => 'Data',
            'mask' => '99/99/9999'
        ]);

        DB::table('cms_mascaras')->insert([
            'id' => 3,
            'nome' => 'CPF',
            'mask' => '999.999.999-99'
        ]);

		DB::table('cms_mascaras')->insert([
            'id' => 4,
            'nome' => 'CEP',
            'mask' => '99999-999'
        ]);

		DB::table('cms_mascaras')->insert([
            'id' => 5,
            'nome' => 'RG',
            'mask' => '[99999]9999999'
        ]);
    }
}
