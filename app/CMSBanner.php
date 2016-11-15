<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSBanner extends Authenticatable {

    protected $table = 'cms_banners';

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

    /*
     * Busa a página relacionada
     */

    public function pagina() {
        return $this->belongsTo('NanoCMS\CMSPagina');
    }

}
