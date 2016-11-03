<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSConfig extends Authenticatable {

    protected $table = 'cms_configs';

    /**
     * Busca valor de configuração
     */
    public function getVal($key) {
        $val = CMSConfig::where('chave', '=', $key)->get()->first();
        return $val;
    }

}
