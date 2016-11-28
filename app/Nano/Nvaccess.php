<?php

namespace Nano\Nano;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Nvaccess extends Authenticatable {

    protected $table = 'nvaccess';

    /**
     * Usuários com mesmo nível de acesso
     */
    public function usuarios() {
        return $this->belongsToMany('Nano\NanoCMS\CMSUser');
    }

}
