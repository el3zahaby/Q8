<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function get_ar_page($slug)
    {
        $slug = substr( $slug , 0 , -3);
        $page = \App\Page::where('slug',$slug.'-ar')->get();
        $result = '';
        foreach($page as $p)
        {
            $result = $p->id;
        }
        return $result;
    }
}
