<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(ConfigsSeeder::class);
        $this->call(UsersSeeder::class);
        //$this->call(PaginasSeeder::class);
        //$this->call(MenusSeeder::class);
        //$this->call(MenusItensSeeder::class);
        //$this->call(FormsSeeder::class);
        //$this->call(FormsItensSeeder::class);
        //$this->call(BlocosSeeder::class);
        //$this->call(BlocosPaginasSeeder::class);
        //$this->call(CategoriasSeeder::class);
        //$this->call(PostsSeeder::class);
        //$this->call(BannersSeeder::class);
        //$this->call(GaleriasSeeder::class);
        //$this->call(GaleriasItensSeeder::class);
        $this->call(NiveisSeeder::class);
        $this->call(NvaccessSeeder::class);
    }

}
