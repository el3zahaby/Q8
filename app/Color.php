<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Color extends Model
{
    // use Translatable;
    protected $translatable = ['name'];
    protected $guarded = [];

    public static function getNameById($id)
    {
        $color = Color::find($id);
        return $color ? $color->name : '';
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Tsize');
    }

}
