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
        DB::table('configs')->insert([
            'sitename' => 'Nome do site',
            'sitedesc' => 'Descrição rápida do site',
            'endereco' => 'Endereço da empresa',
            'base' => 'http://basedosite.com',
            'telefone' => '(xx) xxxx-xxxx',
            'email' => 'contato@seusite.com.br',
            'mailuser' => 'testemail@teste.com.br',
            'mailpass' => 'testemail.senha',
            'mailport' => '587',
            'mailhost' => 'http://seusite.com',
            'mailresp' => '<p>Email de resposta automática.</p>',
            'imgprincipal' => 'imagem_principal.png',
            'qntmenulist' => '3',
            'qntdestlist' => '10',
            'qntpostlist' => '5',
            'pagpost' => '5',
            'pagpaginas' => '10',
        ]);
    }
}
