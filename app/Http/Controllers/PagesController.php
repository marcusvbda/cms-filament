<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function show($slug = "index")
    {
        $blade  = str_replace("/", ".", $slug);
        $page = Page::where('blade', $blade)->where("is_published", true)->firstOrFail();
        if (!view()->exists($page->blade)) abort(404);
        $attributes = (object)collect($page->pageAttributes->map(function ($row) {
            $type = match ($row->type) {
                'text' => 'text',
                'editor' => 'text',
                default => $row->type,
            };
            $index = $type . "Value";
            $value = $row->{$index};
            if (in_array($type, ['file', 'image'])) {
                $value = Storage::url($value);
            }
            return ['key' => $row->key, 'value' => $value];
        }))->pluck('value', 'key')->toArray();
        return view($page->blade, compact('page', 'attributes'));
    }
}
