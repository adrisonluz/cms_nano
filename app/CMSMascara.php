<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSMascara extends Authenticatable {

    protected $table = 'cms_mascaras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mask',
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
    * Inputs pai
    */
    public function inputs(){
        return $this->hasMany('NanoCMS\CMSfield', 'mascara_id');
    }
}
