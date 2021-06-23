<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'file';

    function getGetDatastatusAttribute()
    {
        if($this->status == 1)
            return '<span class="label label-success">Aktif</span>';
        else
            return '<span class="label label-danger">Tidak Aktif</span>';
    }

    function getGetJmldownloadAttribute()
    {
        return '<span class="label label-info">'.$this->download.' &nbsp; <i class="fa fa-download"></i></span>';
    }
}