<?php

return [
    'routes' => [
        'prefix' => 'mdigi',
        'middleware' => ['web'],
    ],
    'database' => [
        'connection' => 'pbb',
    ],
    'transaksi' => [
        'max_year_backward' => 10
    ],
];