const mix = require('laravel-mix')
const path = require('path')

require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .vue({ version: 3 })
  .sass('resources/sass/tool.scss', 'css')
  .alias({
    '@': path.join(__dirname, 'resources/js/')
  })
  .nova('begleweyer/page-builder')
