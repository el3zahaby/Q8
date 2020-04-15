<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public function color(){
        return $this->hasOne(Color::class);
    }

    public function tsize(){
        return $this->hasOne(Tsize::class);
    }

}
