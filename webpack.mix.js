let mix = require('laravel-mix');
// import { mix } from "laravel-mix";

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css')
//     .setPublicPath('public');

// Compilation des fichiers JavaScript et minification
mix.js('resources/js/app.js', 'public/js')
    .minify('public/js/app.js')  // Minification du fichier compilé

// Compilation des fichiers CSS/SASS et minification
mix.css('resources/css/app.css', 'public/css') // Compilation SASS
    .minify('public/css/app.css') // Minification du fichier compil

    // Activation du versioning pour éviter les problèmes de cache
    .version()

    // Ajout des sourcemaps pour faciliter le débogage en développement
    .sourceMaps()

    // Définition du chemin public
    .setPublicPath('public');

