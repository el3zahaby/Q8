<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    protected $with = ['color', 'tsize'];
    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function tsize(){
        return $this->belongsTo(Tsize::class);
    }

}
