<?php

use Illuminate\Database\Seeder;

class PaginasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cms_paginas')->insert([
        'id' => 0,
        'titulo' => 'Todas',
        'conteudo' => '',
        'resumo' => '',
        'imagem' => '',
        'data' => '',
        'url' => '',
        'ativo' => '',
        'lixeira' => '',
        'agent_id' => '',
        'created_at' => '',
        'updated_at' => ''
      ]);
    }
}
