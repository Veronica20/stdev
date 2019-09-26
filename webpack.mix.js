const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copy('node_modules/bootstrap/dist', 'public/libs/bootstrap')
    .copy('node_modules/jquery/dist', 'public/libs/jquery')
    .copy('node_modules/datatables/media', 'public/libs/datatables')
    .copy('resources/sass/app.css', 'public/css')

;
