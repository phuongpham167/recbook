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

mix.sass('public/sass/list-real-estate.scss', 'public/css')
    .sass('public/sass/right-sidebar.scss', 'public/css')
    .sass('public/sass/detail-real-estate.scss', 'public/css')
    .sass('public/sass/manage-real-estate.scss', 'public/css')
    .sass('public/sass/detail-conversation.scss', 'public/css')
    .sass('public/sass/user-info.scss', 'public/css');
