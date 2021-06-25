<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class TentangAplikasi extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $table = 'tentang_aplikasi';

    function getGetDescAttribute()
    {
        $desc = str_replace(array('&nbsp;'),'',strip_tags($this->deskripsi));
        return Str::limit($desc, 180, '[...]');
    }
}