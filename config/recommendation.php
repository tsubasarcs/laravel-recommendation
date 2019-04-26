<?php
return [
    'relation_model' => \Tsubasarcs\Recommendations\Tests\Illuminate\User::class,
    'default' => [
        'type' => 1,
        'length' => 10,
    ],
    'prevent_repeat' => [
        'model' => \Tsubasarcs\Recommendations\Recommendation::class,
        'column' => 'code',
    ]
];
