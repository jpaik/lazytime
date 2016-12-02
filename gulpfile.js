var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

 var paths = {
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'jquery': './node_modules/jquery/dist/',
    'fa': './node_modules/font-awesome/'
}

elixir(function(mix) {
    mix.sass('app.scss', 'public/css/style.css')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
        .copy(paths.fa + 'fonts/**', 'public/fonts')
        .scripts([
          paths.jquery + 'jquery.js',
          paths.bootstrap + 'javascripts/bootstrap.js'
        ], 'public/js/library.js', './')
        .scripts([
          'script.js'
        ],'public/js/script.js');
});
