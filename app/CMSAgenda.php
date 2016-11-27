<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSAgenda extends Authenticatable {

    protected $table = 'cms_agendas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'tipo,'
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
}

