<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagesController extends Controller
{
    public function show($slug = "index")
    {
        $blade  = str_replace("/", ".", $slug);
        $page = Page::where('blade', $blade)->where("is_published", true)->firstOrFail();
        if (!view()->exists($page->blade)) abort(404);
        $attributes = $page->getProcessedAttributes();
        $responseType = request()->responseType ?? 'blade';
        if ($responseType == 'json') return response()->json(['title' => $page->title, 'attributes' => $attributes]);
        return view($page->blade, compact('page', 'attributes'))->render();
    }
}
