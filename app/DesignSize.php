<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignSize extends Model
{
    protected $table =  'design_dsize' ;
    protected $with = ['dsize','design'];
    public function dsize()
    {
        return $this->hasOne('App\Dsize' , 'id' , 'dsize_id');
    }
    public function design()
    {
        return $this->hasOne( 'App\Design' , 'id' , 'design_id' );
    }
}
