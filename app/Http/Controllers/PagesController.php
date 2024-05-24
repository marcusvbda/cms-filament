<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Page;
use App\Models\Parameter;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show($slug = "index")
    {
        $slug  = str_replace("/", ".", $slug);
        $page = Page::where('slug', $slug)->where("is_published", true)->firstOrFail();
        $pageAttributes = $page->getProcessedAttributes();
        $siteParameters = Parameter::where('key', "like", "site_%")->get();
        $siteAttributes = [];
        foreach ($siteParameters as $parameter) {
            $siteAttributes[$parameter->key] = $parameter->value;
            if ($parameter->type === 'component') {
                $siteAttributes[$parameter->key] = Component::find($parameter->value)->getProcessedAttributes();
            }
        }
        if ($page->type === 'api') return response()->json(['title' => $page->title, 'pageAttributes' => $pageAttributes]);
        if (!view()->exists($page->slug)) abort(404);
        return view($page->slug, compact('page', 'pageAttributes', 'siteAttributes'))->render();
    }

    public function setLanguage(Request $request, $lang)
    {
        $headers = $request->headers;
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
