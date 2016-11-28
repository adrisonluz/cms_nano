<?php

namespace Nano\NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CMSMenu extends Authenticatable {

    protected $table = 'cms_menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'tipo',
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
        ->orWhereIn('lixeira', ['', 'nao']);
    }


    /**
    * Itens relacionados
    */
    public function itens(){
        return $this->hasMany('Nano\NanoCMS\CMSMenuItens', 'menu_id');
    }

}
