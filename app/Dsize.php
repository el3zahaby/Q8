<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Dsize extends Model
{
    protected $guarded = [];

    public static function getStrById($id)
    {
        $dsize = Dsize::find($id);
        return $dsize ? $dsize->length . ' X ' . $dsize->width : '';
    }
}
