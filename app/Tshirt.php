<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tshirt extends Model
{
    use SoftDeletes;

    protected $with = ['color', 'tsize'];
    public function color(){
        return $this->belongsTo(Color::class)->withTrashed();
    }

    public function tsize(){
        return $this->belongsTo(Tsize::class)->withTrashed();
    }

}
