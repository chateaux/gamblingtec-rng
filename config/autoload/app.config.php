<?php
return [
    'routes' => [
        [
            'name' => 'rng',
            'short_description' => 'Invole the RNG',
            'handler' => Application\Command\Rng::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
        ],
        'factories' => [
            Application\Command\Rng::class => function ($container, $requestedName) {
                return new Application\Command\Rng(
                    $container->get('config')['general']
                );
            },
        ],
    ],
];
