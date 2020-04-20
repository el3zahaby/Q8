<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Design extends Model
{
    protected $guarded = [];

    public function isAccepted($string = false){
        $cond = (boolean)$this->accepting;

        if ($string){
            $cond= ($cond) ?'YES':"NO";
        }

        return $cond;
    }
    public function dsizes()
    {
        return $this->belongsToMany('App\Dsize' );
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Tsize');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function design_sizes(){
        return $this->hasMany(DesignSize::class );
    }

    public function has_dsize($dsize_id)
    {
        $result = false;
        $dsizes = $this->design_sizes;

        foreach($dsizes as $dsize)
        {
            if($dsize->dsize->id == $dsize_id)
            {
                $result = true;
                break;
            }
        }
        return $result;
    }
    public function dsize_price($dsize_id)
    {
        $result = false;
        $dsizes = $this->design_sizes;
        foreach($dsizes as $dsize)
        {
            if($dsize->dsize->id == $dsize_id)
            {
                return $dsize->designer_price;
            }
        }
        return $result;
    }

    public static function boot(){
        parent::boot();

        static::creating(function($table)
        {
            $first =  Design::first();
            if(!$first){
                $table->id = config('app.firstId');
            }
        });
    }
}
