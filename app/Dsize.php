<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dsize extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function getStrById($id)
    {
        $dsize = Dsize::find($id);
        return $dsize ? $dsize->length . ' X ' . $dsize->width : '';
    }
}
