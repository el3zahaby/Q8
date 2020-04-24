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
        return substr($this->slug, 0, -3);
    }

    public function ar($slug = null)
    {
        // return $slug;
        if ($slug != null) {
            // $slug = explode('-', $slug)[0];
            $slug = substr($slug, 0, -3);
        }else{
            $slug = substr($this->slug, 0, -3);
        }
        $page = \App\Page::where('slug',$slug.'-ar')->first();


        return $page ?? [];
    }

}
