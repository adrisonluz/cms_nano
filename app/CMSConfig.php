<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSConfig extends Authenticatable {

    protected $table = 'cms_configs';
    public $timestamps = false;

    /**
     * Busca valor de configuração
     */
    public function getVal($key) {
        $val = CMSConfig::where('chave', '=', $key)->get()->first();
        return $val;
    }

}
