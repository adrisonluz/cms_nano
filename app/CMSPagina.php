<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSPagina extends Authenticatable {

    protected $table = 'cms_paginas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'url', 'data', 'resumo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /*
     * Trata e salva imagem de perfil
     */

    public function setImagem($imagemCod, $nomeArquivo) {
        $imagem = str_replace('data:image/png;base64,', '', $imagemCod);
        $imgReturn = base64_decode($imagem);

        if (Storage::disk('paginas')->put($nomeArquivo, $imgReturn, 'public')) {
            return true;
        }
    }

}
