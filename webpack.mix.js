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

mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/src'),
                '@sass': path.resolve(__dirname, 'resources/sass'),
                '@assets': path.resolve(__dirname, 'resources/assets')
            }
        }
    })
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images'); // Copy all images from resources to public folder


// Change below options according to your requirement
if (mix.inProduction()) {
    mix.version();
    mix.webpackConfig({
        output: {
            chunkFilename: 'js/chunks/[name].[chunkhash].js',
        }
    });
}
else {
    mix.webpackConfig({
        output: {
            chunkFilename: 'js/chunks/[name].js',
        }
    });
}