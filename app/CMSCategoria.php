<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CMSCategoria extends Authenticatable {

    protected $table = 'cms_categorias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Padrão de busca
     */
    public function scopeAtivos() {
        return $this->whereNull('lixeira')
        ->orWhereIn('lixeira', ['', 'nao'])
        ->where('id', '!=', 0);
    }


}
