<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterMenu extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'master_menu';

    function getParent()
    {
        return $this->belongsTo('App\Models\MasterMenu','parent');
    }
}
