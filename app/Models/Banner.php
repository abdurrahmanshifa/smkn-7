<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'banner';

    function getStatusBannerAttribute()
    {
        if($this->attributes['status'] == 1)
            return '<span class="label label-success">Aktif</span>';
        else
            return '<span class="label label-danger">Tidak Aktif</span>';
    }

    function getBannerAttribute()
    {
        return "<img src='".url('app/banner/'.$this->attributes['images'])."' style='width:200px !important;'> ";
    }

}