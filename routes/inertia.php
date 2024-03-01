<?php

    use Illuminate\Support\Facades\Route;
    use Laravel\Nova\Http\Requests\NovaRequest;

    Route::get('/{id}', function (NovaRequest $request, $id) {
        // Todo Brandon: Need to get these dynamically later
        $assetManagerAssets = [
            [
                'src'    => 'http://placehold.it/350x250/79c267/fff/image3.jpg',
                'height' => 350,
                'width'  => 250,
                'name'   => 'displayName'
            ],
            [
                'src'    => 'http://placehold.it/350x250/79c267/fff/image3.jpg',
                'height' => 350,
                'width'  => 250,
                'name'   => 'displayName'
            ]
        ];
        $cssPath = config('nova-grapesjs-page-builder.app-css-path');
        return Inertia('PageBuilder', [
            'id'     => $id,
            'appCss' => $cssPath,
            'assetManagerAssets' => $assetManagerAssets
        ]);
    });
