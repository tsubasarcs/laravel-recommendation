<?php
return [
    'model' => [
        'name' => \Tsubasarcs\Recommendations\Recommendation::class,
        'code_column' => 'code',
    ],
    'relation_model' => \Tsubasarcs\Recommendations\Tests\Illuminate\User::class,
    'default' => [
        'type' => 1,
        'length' => 10,
    ],
];
