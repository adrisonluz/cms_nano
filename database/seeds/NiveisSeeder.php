<?php

use Illuminate\Database\Seeder;

class NiveisSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('niveis')->insert([
            'nivel' => 'admin',
        ]);

        DB::table('niveis')->insert([
            'nivel' => 'user',
        ]);
    }

}
