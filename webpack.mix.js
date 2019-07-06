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

//mix.js('resources/js/app.js', 'public/assets/js');//.extract([ 'vue']);
//mix.sass('resources/sass/app.scss', 'public/assets/css');


// Override mix internal webpack output configuration
mix.config.webpackConfig.output = {
    chunkFilename: 'assets/vue/[name].bundle.js',
    publicPath: '/',
};

mix.js('resources/js/app.js', 'public/assets/vue')
   .sass('resources/sass/app.scss', 'public/assets/vue');
   //.version(); 
if (mix.inProduction()) {
    mix.version();
}
