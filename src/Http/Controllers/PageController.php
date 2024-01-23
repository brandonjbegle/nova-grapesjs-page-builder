<?php

namespace BrandonJBegle\NovaGrapesjsPageBuilder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getHtml($id)
    {
        $page = Page::where('id', '=', $id)->first();
        if (! $page) {
            abort(404);
        }

        return response()->json([
            'content' => $page ? $page->content : null,
            'custom_css' => $page ? $page->custom_css : null,
        ]);
    }

    public function storeTemp(Request $request, $id)
    {
        $page = Page::where('id', '=', $id)->first();
        if (! $page) {
            abort(404);
        }

        $page->temp_content = $request->get('content');
        $page->temp_custom_css = $request->get('css');

        $page->save();

        return response()->json(['message' => 'success']);
    }

    public function storePage(Request $request, $id)
    {
        $page = Page::where('id', '=', $id)->first();
        if (! $page) {
            abort(404);
        }

        $page->temp_content = $request->get('content');
        $page->content = $request->get('content');
        $page->custom_css = $request->get('css');
        $page->temp_custom_css = $request->get('css');
        $page->save();

        return response()->json($page);
    }
}
