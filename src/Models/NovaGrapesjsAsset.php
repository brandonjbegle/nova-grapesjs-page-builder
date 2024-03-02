<?php

    namespace BrandonJBegle\NovaGrapesjsPageBuilder\Models;

    use Illuminate\Database\Eloquent\Model;

    class NovaGrapesjsAsset extends Model
    {
        protected $guarded = [];

        protected $appends = [
            'url'
        ];

        public function getUrlAttribute(){

        }
  }
