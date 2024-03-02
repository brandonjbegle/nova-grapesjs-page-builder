<?php

    use BrandonJBegle\NovaGrapesjsPageBuilder\Http\Controllers\AssetController;
    use BrandonJBegle\NovaGrapesjsPageBuilder\Http\Controllers\PageController;
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

Route::get('/page/{id}', [PageController::class, 'getHtml']);
Route::post('/page/{id}/temp', [PageController::class, 'storeTemp']);
Route::post('/page/{id}/save', [PageController::class, 'storePage']);

Route::post('/asset-manager-upload', [AssetController::class, 'storeAsset']);
