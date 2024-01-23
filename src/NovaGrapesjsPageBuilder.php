<?php

namespace BrandonJBegle\NovaGrapesjsPageBuilder;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaGrapesjsPageBuilder extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-3-grapesjs-page-builder', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-3-grapesjs-page-builder', __DIR__.'/../dist/css/tool.css');
    }

    public function menu(Request $request)
    {
//        return MenuSection::make('Page Builder')
//            ->path('/page-builder')
//            ->icon('list');
    }
}
