<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/page/{id}', [\Begleweyer\Nova3GrapesjsPageBuilder\Http\Controllers\PageController::class, 'getHtml']);
Route::post('/page/{id}/temp', [\Begleweyer\Nova3GrapesjsPageBuilder\Http\Controllers\PageController::class, 'storeTemp']);
Route::post('/page/{id}/save', [\Begleweyer\Nova3GrapesjsPageBuilder\Http\Controllers\PageController::class, 'storePage']);
