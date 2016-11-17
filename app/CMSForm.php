<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSForm extends Authenticatable {

    protected $table = 'cms_forms';

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
        ->orWhereIn('lixeira', ['', 'nao'])
        ->orderBy('ordem');
    }

    /**
    * Página relacionada
    */
    public function pagina(){
        return $this->belongsTo('NanoCMS\CMSPagina');
    }    

    /**
    * Fields relacionados
    */
    public function fields(){
        return $this->hasMany('NanoCMS\CMSField', 'form_id');
    }
}
