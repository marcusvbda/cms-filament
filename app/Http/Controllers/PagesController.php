<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagesController extends Controller
{
    public function show($slug = "index")
    {
        $slug  = str_replace("/", ".", $slug);
        $page = Page::where('slug', $slug)->where("is_published", true)->firstOrFail();
        $attributes = $page->getProcessedAttributes();
        if ($page->type === 'api') return response()->json(['title' => $page->title, 'attributes' => $attributes]);
        if (!view()->exists($page->slug)) abort(404);
        return view($page->slug, compact('page', 'attributes'))->render();
    }

    public function setLanguage($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
