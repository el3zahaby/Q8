<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Design extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $with = ['dsizes'];
    protected $appends = ['thump','name','desc','designer_price'];
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
    public function getNameAttribute(){
        if(isset($_COOKIE['locale']) && ($_COOKIE['locale'] == 'ar' or $_COOKIE['locale'] == 'AR')){
            return$this->name_ar;
        }else{
            return$this->name_en;
        }
    }
    public function getDescAttribute(){
        if(isset($_COOKIE['locale']) && ($_COOKIE['locale'] == 'ar' or $_COOKIE['locale'] == 'AR')){
            return$this->desc_ar;
        }else{
            return$this->desc_en;
        }
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

    public function getDesignerPriceAttribute(){
        $arr = collect();
        $i= 0;
        foreach ((json_decode($this->attributes['designer_price']) ?? []) as $key=>$item){
            $arr[$i]=json_decode($this->attributes['designer_price'])[$i];

            $arr[$i]->dsize= Dsize::find($item->dsize_id);

            $i++;
        }
        return $arr;

    }

    public function design(){
        return $this->belongsTo(Design::class)->withTrashed();
    }

    public function has_dsize($dsize_id)
    {
        $result = false;
        $dsizes = $this->designer_price->pluck('dsize');
//        dd($dsizes);

        foreach($dsizes as $dsize)
        {

            if($dsize->id == $dsize_id)
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
        $dsizes = $this->designer_price->where('dsize_id',$dsize_id);
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
