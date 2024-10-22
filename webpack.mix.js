let mix = require('laravel-mix');
// import { mix } from "laravel-mix";

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .setPublicPath('public');

// mix.styles('public/assets/admin/css/style.css', 'public/css/app.css');
