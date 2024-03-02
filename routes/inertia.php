<?php

    use Illuminate\Support\Facades\Route;
    use Laravel\Nova\Http\Requests\NovaRequest;

    Route::get('/{id}', function (NovaRequest $request, $id) {
        $assetModel = config('nova-grapesjs-page-builder.asset-model');

        $assets = $assetModel::all();

        $assets->transform(function ($item) {
            return [
                'src'    => $item->url,
                'height' => $item->height,
                'width'  => $item->width
            ];
        });

        $cssPath = config('nova-grapesjs-page-builder.app-css-path');
        return Inertia('PageBuilder', [
            'id'     => $id,
            'appCss' => $cssPath,
            'assetManagerAssets' => $assets
        ]);
    });
