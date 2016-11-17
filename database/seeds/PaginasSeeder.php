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
        'id' => 1,
        'titulo' => 'Home',
        'conteudo' => '<h1>Bem vindo ao seu site!</h1>',
        'resumo' => '',
        'imagem' => '',
        'data' => '',
        'url' => '/',
        'ativo' => 'sim',
        'lixeira' => '',
        'agent_id' => 1,
        'created_at' => '',
        'updated_at' => ''
      ]);
    }
}
