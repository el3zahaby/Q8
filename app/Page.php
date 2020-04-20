<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed slug
 */
class Page extends Model
{
//    protected $fillable = ['body'];
    protected $guarded = [];

    public function getBaseSlugAttribute(){
        return explode('-', $this->slug)[0];
    }

    public function ar($slug = null)
    {
        if ($slug != null) {
            $slug = explode('-', $slug)[0];
        }else{
            $slug = explode('-', $this->slug)[0];
        }
        $page = \App\Page::where('slug',$slug.'-ar')->first();

        return $page ?? [];
    }

}
