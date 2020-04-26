<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignsCollections extends Model
{
    use SoftDeletes;

    protected $with = ['design'];
    protected $appends = ['tshirts'];
    public function getTshirtIdAttribute(){
        return json_decode($this->attributes['tshirt_id']);
    }

    public function getTshirtsAttribute(){
        $arr = collect();
        foreach ($this->tshirt_id as $t){
            $arr->push(Tshirt::find($t) ?? []);
        }
        return $arr;
    }

    public function design(){
        return $this->belongsTo(Design::class);
    }
}
