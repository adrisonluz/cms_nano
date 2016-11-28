<?php

namespace Nano\NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSUser extends Authenticatable {

    protected $table = 'cms_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Trata e salva imagem de perfil
     */

    public function setImagemFoto($imagemCod, $nomeArquivo) {
        $imagem = str_replace('data:image/png;base64,', '', $imagemCod);
        $imgReturn = base64_decode($imagem);

        if (Storage::disk('perfil')->put($nomeArquivo, $imgReturn, 'public')) {
            return true;
        }
    }

    /**
     * Nível de acesso
     */
    public function rel_nivel() {
        return $this->hasOne('Nano\Nano\Nivel', 'id', 'nivel');
    }

}
