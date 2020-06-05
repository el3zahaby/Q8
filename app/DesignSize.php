<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignSize extends Model
{
    use SoftDeletes;

    protected $table =  'design_dsize';
    protected $with = ['dsize','design'];
    public function dsize()
    {
        return $this->hasOne('App\Dsize' , 'id' , 'dsize_id')->withTrashed();
    }
    public function design()
    {
        return $this->hasOne( 'App\Design' , 'id' , 'design_id' )->withTrashed();
    }
}
