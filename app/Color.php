<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;


class Color extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public static function getNameById($id)
    {
        $color = Color::find($id);
        return $color ? $color->name : '';
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Tsize')->withTrashed();
    }

}
