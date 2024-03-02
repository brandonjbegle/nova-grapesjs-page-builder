<?php

    // Todo Brandon: For previews, would also need a route for that
    // Todo Brandon: Provide a preview template by default that they can publish and edit?
    return [
        'page-model'         => \BrandonJBegle\NovaGrapesjsPageBuilder\Models\Page::class,
        'asset-model'        => \BrandonJBegle\NovaGrapesjsPageBuilder\Models\NovaGrapesjsAsset::class,
        'app-css-path'       => null,
        'preview-blade-name' => null,
        'asset-manager-disk' => null
    ];
