<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tsize extends Model
{
    protected $guarded = [];

    public static function getSizeStrById($id)
    {
        $size = Tsize::find($id);
        return $size ? $size->name : '';
    }
}
