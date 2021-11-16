<?php

return [
    'routes' => [
        'prefix' => 'mdigi',
        'middleware' => ['web'],
    ],
    'database' => [
        'connection' => 'pbb',
        'type' => 'SIMPBB', //change DB type: SISMIOP / SIMPBB
    ],
    'transaksi' => [
        'max_year_backward' => 10
    ],
];