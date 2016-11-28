<?php

namespace Nano\NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CMSMenuItens extends Authenticatable {

    protected $table = 'cms_menus_itens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'link', 'tipo',
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
    * Menu pai
    */
    public function menu(){
        return $this->belongsTo('Nano\NanoCMS\CMSMenu');
    }

    /**
    * Item pai
    */
    public function itemPai(){
        return $this->belongsTo('Nano\NanoCMS\CMSMenuItens', 'menupai_id');
    }
}
