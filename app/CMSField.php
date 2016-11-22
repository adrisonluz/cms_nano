<?php

namespace NanoCMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class CMSField extends Authenticatable {

    protected $table = 'cms_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'valor', 'placeholder', 'obrigatorio', 'tipo'
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
    * Form pai
    */
    public function form(){
        return $this->belongsTo('NanoCMS\CMSForm');
    }

    /**
    * Input pai
    */
    public function inputPai(){
        return $this->belongsTo('NanoCMS\CMSField', 'input_id');
    }

    /**
    * Máscara do input
    */
    public function mascara(){
        return $this->belongsTo('NanoCMS\CMSMascara');
    }

    /**
    *
    */
    public function options(){
        return $this->hasMany('NanoCMS\CMSField', 'input_id');
    }
}
