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

module.exports = {
    //...
    performance: {
        hints: 'warning'
    }
};
let productionSourceMaps = true;
mix.js('resources/js/app-portable.js', 'public/js');

// mix.js('resources/js/app.js', 'public/js').extract(['vue','jquery','bootstrap','axios','validate.js'])
//       .sass('resources/sass/app.scss', 'public/css').sass('resources/sass/front_app.scss', 'public/css') .sass('resources/sass/dark.scss', 'public/css').sass('resources/sass/comman.scss', 'public/css').minify('public/js/app.js', 'public/js').version();

mix.disableNotifications();
