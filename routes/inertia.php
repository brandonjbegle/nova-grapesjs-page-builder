<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;

Route::get('/{id}', function (NovaRequest $request, $id) {
    $cssPath = config('nova-grapesjs-page-builder.app-css-path');
    return Inertia('PageBuilder', [
        'id' => $id,
        'appCss' => $cssPath
    ]);
});
