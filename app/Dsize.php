<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dsize extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = ['designer_print_price'];
    public static function getStrById($id)
    {
        $dsize = Dsize::find($id);
        return $dsize ? $dsize->length . ' X ' . $dsize->width : '';
    }
    public function getDesignerPrintPriceAttribute(){
        return $this->print_price + $this->design_sizes->designer_price;
    }
    public function design_sizes(){
        return $this->hasMany(DesignSize::class);
    }
}
