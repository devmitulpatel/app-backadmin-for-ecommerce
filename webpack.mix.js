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
let productionSourceMaps = true;

mix.js('resources/js/app.js', 'public/js').extract(['vue','jquery','bootstrap','axios','validate.js'])
    .sass('resources/sass/app.scss', 'public/css') .sass('resources/sass/dark.scss', 'public/css').sass('resources/sass/comman.scss', 'public/css');

mix.disableNotifications();
