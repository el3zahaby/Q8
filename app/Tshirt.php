<?php

namespace App;

use App\Http\Controllers\StatisticController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 */
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

    public function ordered(){
        return count(StatisticController::getSoldTshirt($this->id));
    }

}
