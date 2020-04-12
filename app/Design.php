<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Design extends Model
{
    public function dsizes()
    {
        return $this->belongsToMany('App\Dsize');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Tsize');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
