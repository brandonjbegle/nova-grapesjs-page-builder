<?php

    namespace BrandonJBegle\NovaGrapesjsPageBuilder\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Ramsey\Uuid\Uuid;

    class AssetController extends Controller
    {
        // Todo Brandon: Give the option for another class override in the config
        // Todo Brandon: Could also allow for a controller override... How would we do that?
        // Todo Brandon: need a way to delete an image.. Is there an endpoint for that
        public function store(Request $request)
        {
            $files = $request->file('files');

            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->createFile($file);
                }
            } else {
                $this->createFile($files);
            }

            $assetModel = config('nova-grapesjs-page-builder.asset-model');

            $assets = $assetModel::all();

            $assets->transform(function ($item) {
                return [
                    'src'    => $item->url,
                    'height' => $item->height,
                    'width'  => $item->width
                ];
            });

            return response()->json([
                'data' => $assets
            ]);
        }

        protected function createFile($file)
        {
            $assetModel = config('nova-grapesjs-page-builder.asset-model');
            $disk = config('nova-grapesjs-page-builder.asset-manager-disk');

            $fileName = Uuid::uuid4().'.'.$file->getClientOriginalExtension();

            list($fileWidth, $fileHeight) = getimagesize($file->getRealPath());

            $path = Storage::disk($disk)->put($fileName, $file);

            $assetModel::create([
                'disk'   => $disk,
                'path'   => $path,
                'height' => $fileHeight,
                'width'  => $fileWidth
            ]);
        }
    }
