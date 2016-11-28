<?php

namespace Nano\Nano;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Nivel extends Authenticatable {

    protected $table = 'niveis';

    /**
     * Usuários com mesmo nível de acesso
     */
    public function usuarios() {
        return $this->belongsToMany('Nano\NanoCMS\CMSUser');
    }

}
