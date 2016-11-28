<?php

namespace Nano\NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->hasMany('Nano\NanoCMS\CMSfield', 'mascara_id');
    }
}
