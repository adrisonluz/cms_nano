<?php

use Illuminate\Database\Seeder;

class NvaccessSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('nvaccess')->insert([
            'key' => 'all',
        ]);
    }

}
