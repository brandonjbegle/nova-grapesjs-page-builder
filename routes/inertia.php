<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;

Route::get('/{id}', function (NovaRequest $request, $id) {
    return Inertia('PageBuilder', [
        'id' => $id
    ]);
});
