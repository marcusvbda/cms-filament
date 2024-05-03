<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagesController extends Controller
{
    public function show($slug = "index")
    {
        $page = Page::where('slug', $slug)->where("is_published", true)->firstOrFail();
        return view($page->slug, compact('page'));
    }
}
