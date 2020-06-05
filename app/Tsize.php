<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tsize extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function getSizeStrById($id)
    {
        $size = Tsize::find($id);
        return $size ? $size->name : '';
    }
}
