<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Design extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $with = ['dsizes'];
    protected $appends = ['thump'];
    public function isAccepted($string = false){
        $cond = (boolean)$this->accepting;

        if ($string){
            $cond= ($cond) ?'YES':"NO";
        }

        return $cond;
    }

    public function getThumpAttribute(){
        $img = pathinfo($this->attributes['img']);
       return $img['dirname'].'/thump/'.$img['basename'];
    }

    public function dsizes()
    {
        return $this->belongsToMany('App\Dsize' )->withTrashed();
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


    public function total($size){
        return ($this->has_dsize($size->id) ? $this->dsize_price($size->id) : 0) + $size->print_price;
    }

    public function dcollections(){
        return $this->hasOne(DesignsCollections::class);
    }


    public static function boot(){
        parent::boot();

        static::creating(function($table)
        {
            $first =  Design::withTrashed()->first();
            if(!$first){
                $table->id = config('app.firstId');
            }
        });
    }
}
