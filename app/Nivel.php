<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Nivel extends Authenticatable {

    protected $table = 'niveis';

    /**
     * Usuários com mesmo nível de acesso
     */
    public function usuarios() {
        return $this->belongsToMany('NanoCMS\CMSUser');
    }

}
