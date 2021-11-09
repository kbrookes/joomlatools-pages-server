<?php

return [

    'cache_path' => getenv('APP_VOLUME').'/utrr/cache',
    'log_path'   => getenv('APP_VOLUME').'/utrr/log',

    'redirects' =>  include __DIR__.'/redirects.php',

    'extension_config'     =>
    [
        'ext:airtable.model.records' => [
            'api_key' => 'keyvuFe20ZrHxoipH'
        ],

        'ext:storyblok.model.companies' => [
            'api_key' => 'qUIRVFhERHNhylrUuoPvBAtt'
        ],
        'ext:storyblok.model.blog' => [
            'api_key' => 'qUIRVFhERHNhylrUuoPvBAtt'
        ],
        'ext:storyblok.model.authors' => [
            'api_key' => 'qUIRVFhERHNhylrUuoPvBAtt'
        ],
    ]
];
