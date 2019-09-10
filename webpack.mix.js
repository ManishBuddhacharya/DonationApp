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
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/css/font-awesome.css',
    'resources/css/bootstrap.min.css',
    'resources/css/owl-carousel.css',
    'resources/css/mediaelementplayer.min.css',
    'resources/css/layerslider.css',
    'resources/css/revolution.css',
    'resources/css/settings.css',
    'resources/css/animate.min.css',
    'resources/css/style.css',
    'resources/css/responsive.css',
    'resources/css/red.css',
    'resources/css/wedgewood.css',
    'resources/css/blue.css',
    'resources/css/green.css',
    'resources/css/darkgreen.css',
    'resources/css/donation.css',
    'node_modules/magnific-popup/dist/magnific-popup.css',
    'node_modules/dropzone/dist/dropzone.css',
    'node_modules/toastr/build/toastr.min.css',
    'resources/assets/lib/material-design-icons/css/material-design-iconic-font.min.css',
    'node_modules/sweetalert2/dist/sweetalert2.min.css',
], 'public/css/all.css');

mix.scripts([
    'resources/js/jquery.1.10.2.js',
    'resources/js/modernizr.custom.17475.js',
    'resources/js/jquery.downCount.js',
    'resources/js/bootstrap.min.js',
    'resources/js/jquery.poptrox.min.js',
    'resources/js/enscroll-0.5.2.min.js',
    'resources/js/owl.carousel.min.js',
    'resources/js/mediaelement-and-player.min.js',
    'resources/js/script.js',
    'resources/js/ajax.contact-form.js',
    'resources/js/jquery.knob.js',
    'resources/js/knob-script.js',
    'resources/js/styleswitcher.js',
    'resources/js/jquery.minimalect.min.js',
    'resources/js/greensock.js',
    'resources/js/layerslider.transitions.js',
    'resources/js/layerslider.kreaturamedia.jquery.js',
    'resources/js/jquery.isotope.min.js',
    'resources/js/revolution/jquery.themepunch.tools.min.js',
    'resources/js/revolution/jquery.themepunch.revolution.min.js',
    'resources/js/revolution/extensions/revolution.extension.slideanims.min.js',
    'resources/js/revolution/extensions/revolution.extension.layeranimation.min.js',
    'resources/js/revolution/extensions/revolution.extension.navigation.min.js',
    'node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
    'node_modules/dropzone/dist/dropzone.js',
    'resources/js/OrgChart.js',
    'resources/js/custom.js',
    'resources/js/request.js',
    'node_modules/toastr/build/toastr.min.js',
    'node_modules/sweetalert2/dist/sweetalert2.min.js',
], 'public/js/all.js');


/*--------------
    Backend
 ---------------*/
mix.scripts([
    'resources/js/jquery.1.10.2.js',
    'resources/js/custom.js',
    'resources/js/request.js',
    'node_modules/toastr/build/toastr.min.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/summernote/dist/summernote.min.js',
    'node_modules/sweetalert2/dist/sweetalert2.min.js',
], 'public/js/backend.js');

mix.styles([
    'resources/css/font-awesome.css',
    'resources/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css',
    'resources/assets/lib/material-design-icons/css/material-design-iconic-font.min.css',
    'resources/assets/css/style.css',
    'resources/css/donation.css',
    'node_modules/select2/dist/css/select2.min.css',
    'node_modules/summernote/dist/summernote.css',
    'node_modules/sweetalert2/dist/sweetalert2.min.css',
    ],'public/css/backend.css'); 
 
mix.scripts([
    
    'resources/assests/js/main.js',
    'resources/assests/lib/bootstrap/dist/js/bootstrap.min.js',
    
    ],'public/js/app.js');
