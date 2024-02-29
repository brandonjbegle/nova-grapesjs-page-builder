<?php

namespace BrandonJBegle\NovaGrapesjsPageBuilder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Todo Brandon: Still need to make default migrations
    public function getHtml($id)
    {
        $pageModel = config('nova-grapesjs-page-builder.page-model');
        $page = $pageModel::where('id', '=', $id)->first();
        if (! $page) {
            abort(404);
        }

        // Todo Brandon: Get fields from a config (or a default class & migrations)
        return response()->json([
            'content' => $page ? $page->content : null,
            'custom_css' => $page ? $page->custom_css : null,
        ]);
    }

    public function storeTemp(Request $request, $id)
    {
        $pageModel = config('nova-grapesjs-page-builder.page-model');
        $page = $pageModel::where('id', '=', $id)->first();
        if (! $page) {
            abort(404);
        }

        // Todo Brandon: Get fields from a config (or a default class & migrations)
        $page->temp_content = $request->get('content');
        $page->temp_custom_css = $request->get('css');

        $page->save();

        return response()->json(['message' => 'success']);
    }

    public function storePage(Request $request, $id)
    {
        // Todo Brandon: Get model from a config (or a default class)
        $pageModel = config('nova-grapesjs-page-builder.page-model');
        $page = $pageModel::where('id', '=', $id)->first();
        if (! $page) {
            abort(404);
        }
        // Todo Brandon: Get fields from a config (or a default class & migrations)

        $page->temp_content = $request->get('content');
        $page->content = $request->get('content');
        $page->custom_css = $request->get('css');
        $page->temp_custom_css = $request->get('css');
        $page->save();

        return response()->json($page);
    }
}
