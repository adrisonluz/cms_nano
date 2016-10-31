<?php

use Illuminate\Database\Seeder;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_configs')->insert([
            'chave' => 'sitename',
            'valor' => 'Nome do site',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'sitedesc',
            'valor' => 'Descrição rápida do site',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'endereco',
            'valor' => 'Endereço da empresa',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'base',
            'valor' => 'http://basedosite.com',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'telefone',
            'valor' => '(xx) xxxx-xxxx',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'email',
            'valor' => 'contato@seusite.com.br',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'mailuser',
            'valor' => 'testemail@teste.com.br',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'mailpass',
            'valor' => 'testemail.senha',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'mailport',
            'valor' => '587',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'mailhost',
            'valor' => 'http://seusite.com',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'mailresp',
            'valor' => '<p>Email de resposta automática.</p>',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'imgprincipal',
            'valor' => 'imagem_principal.png',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'qntmenulist',
            'valor' => '3',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'qntdestlist',
            'valor' => '10',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'qntpostlist',
            'valor' => '5',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'pagpost',
            'valor' => '5',
        ]);

        DB::table('cms_configs')->insert([
            'chave' => 'pagpaginas',
            'valor' => '10',
        ]);

    }
}
