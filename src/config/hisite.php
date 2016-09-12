<?php

return [
    'id' => 'hiqdev',
    'name' => 'HiQDev',
    'controllerNamespace' => 'hiqdev\site\controllers',
    'components' => [
        'urlManager' => [
            'class' => \codemix\localeurls\UrlManager::class,
            'languages' => array_keys($params['languages']),
        ],
        'themeManager' => [
            'defaultTheme' => 'original',
            'viewPaths' => [
                '@hiqdev/site/views',
            ],
        ],
    ],
    'modules' => [
        'pages' => [
            'storage' => [
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path'  => '@hiqdev/site/pages',
            ],
        ],
    ],
];
