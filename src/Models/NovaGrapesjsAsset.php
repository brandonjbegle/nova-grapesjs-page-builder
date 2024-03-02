<?php

    namespace BrandonJBegle\NovaGrapesjsPageBuilder\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    class NovaGrapesjsAsset extends Model
    {
        protected $guarded = [];

        protected $appends = [
            'url'
        ];

        public function getUrlAttribute(){
            return Storage::disk($this->disk)->url($this->path);
        }
  }
