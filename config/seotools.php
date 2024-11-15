<?php

/**
 * @see https://github.com/artesaos/seotools
 */


return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "StudyHub - Centralisation des Ressources Académiques",
            'titleBefore'  => false, // false pour mettre le titre de la page en premier
            'description'  => 'Découvrez StudyHub, la plateforme collaborative pour accéder aux ressources académiques de divers établissements scolaires. Accédez facilement à des cours, exercices, devoirs passés, et plus encore.',
            'separator'    => ' - ',
            'keywords'     => ['resources académiques', 'plateforme éducative', 'éducation', 'partage de ressources', 'StudyHub', 'cours', 'devoirs', 'exercices'],
            'canonical'    => env('APP_URL'), // Utilise Url::full() pour définir l'URL canonique complète
            'robots'       => 'index, follow', // Indexable et suivable par les moteurs de recherche
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            // 'google'    => 'votre_google_verification_code',
            // 'bing'      => 'votre_bing_verification_code',
            // 'alexa'     => null,
            // 'pinterest' => null,
            // 'yandex'    => null,
            // 'norton'    => null,
        ],

        'add_notranslate_class' => true, // Ajoute la classe 'notranslate' pour le contenu que vous ne voulez pas traduire
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'StudyHub - Centralisation des Ressources Académiques',
            'description' => 'Accédez aux ressources académiques centralisées de divers établissements scolaires grâce à StudyHub. Plateforme collaborative pour le partage de connaissances.',
            'url'         => env('APP_URL'), // Utilise Url::current() pour définir l'URL actuelle
            'type'        => 'website', // Type d'opengraph - site web
            'site_name'   => 'StudyHub',
            'images'      => ['/assets/global/svg/logo.svg', '/assets/global/img/banner.png'], // Image par défaut pour les partages sociaux
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            // 'card'        => 'summary_large_image', // Carte Twitter au format image large
            // 'site'        => '@votre_compte_twitter', // Compte Twitter associé
        ],
        'https://votre_domaine.com/images/studyhub_logo.png'
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'StudyHub - Centralisation des Ressources Académiques',
            'description' => 'La plateforme collaborative de ressources académiques de divers établissements scolaires. Accédez aux cours, devoirs passés, exercices et bien plus.',
            'url'         => 'full', // Utilise Url::full() pour définir l'URL complète actuelle
            'type'        => 'WebSite', // Type pour le schéma JSON-LD
            'images'      => ['assets/global/svg/logo.svg'], // Image pour JSON-LD
        ],
    ],
];