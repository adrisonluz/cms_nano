<?php

namespace Nano\NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CMSPost extends Authenticatable {

    protected $table = 'cms_posts';

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

    /**
     * Padrão de busca
     */
    public function scopeAtivos() {
        return $this->whereNull('lixeira')
        ->orWhereIn('lixeira', ['', 'nao'])
        ->where('id', '!=', 0);
    }

    /**
    *  Categoria do post
    */
    public function categoria() {
        return $this->belongsTo('Nano\NanoCMS\CMSCategoria');
    }

}
