<?php
return [
    'model' => [
        'name' => \Tsubasarcs\Recommendations\Recommendation::class,
        'code_column' => 'code',
    ],
    'relation_model' => \Tsubasarcs\Recommendations\IlluminateUser::class,
    'default' => [
        'type' => 1,
        'length' => 10,
    ],
    'code_structure' => [
        'prefix' => '',
        'timestamp' => false,
        'symbol' => '-'
    ]
];
