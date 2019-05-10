# Laravel Recommendation

> This package provides to generate user unique code with Laravel.

# Installation

Currently this package only for laravel 5.5.

### Install via composer
```
    $ composer require tsubasarcs/laravel-recommendation
```

### Publish Migration and Config

Run the following to publish the migrations on your terminal:
``` bash
    $ php artisan vendor:publish --provider="Tsubasarcs\Recommendations\RecommendationServiceProvider" --tag="migrations"
```

If you want to change some parameters, you can run the following to publish the config on your terminal:
``` bash
    $ php artisan vendor:publish --provider="Tsubasarcs\Recommendations\RecommendationServiceProvider" --tag="config"
```

# Setting

### Model Recommendation
If you want to do customize model and column, please check Recommendation Model "code" column to prevent code duplicate.
``` php
// config/recommendation.php
...
    'model' => [
        'name' => \Tsubasarcs\Recommendations\Recommendation::class,
        'code_column' => 'code',
    ],
```
Model Recommendation is default belongs to `\Tsubasarcs\Recommendations\IlluminateUser::class`,
You need to change it to your application model.

``` php
// config/recommendation.php
...
    'relation_model' => \Tsubasarcs\Recommendations\IlluminateUser::class,
```

### Default attributes
Generating Code type and length attributes can be customize via setting default key value.

``` php
// config/recommendation.php
...
    'default' => [
        'type' => 1,
        'length' => 10,
    ],
```

Code structure has three parts, `prefix`, `timestamp` and `code`.<br>
You can decide to join `prefix` and `timestamp` or not and custom `symbol` between part and part.

``` php
// config/recommendation.php
...
    // Default only code.
    'code_structure' => [
        'prefix' => '',
        'timestamp' => false,
        'symbol' => '-'
    ]
```

# Usage
### Generating Code
Code Facade end point is `generate()`, it will return an array.

```php
    Code::generate(); 
    // [['type' => 1,'code' => 'X6nbxJ8DHk']];
```

If you are not using endpoint, it will return `CodeService` instance.
```php
    Code::type(2); 
    // Tsubasarcs\Recommendations\CodeService {#result: [], #times: 1, #type: 2, #length: 10};
```

#Example
```php
    Code::prefix('cp')
        ->timestamp(true)
        ->symbol('@')
        ->type(2)
        ->length(15)
        ->times(2)
        ->generate(); 
    // [
    //      ["type" => 2, "code" => "cp@1557454693@4PZHxJXdM7K8OBo"],
    //      ["type" => 2, "code" => "cp@1557454693@rnExFAeD18GDMhs"]
    // ];
    
    'X6nbxJ8DHk'
    // default
    
    'cp-X6nbxJ8DHk'
    // config('recommendation.code_structure.prefix') == 'cp'
    
    '1557287118-Gnr3olcOD6'
    // config('recommendation.code_structure.timestamp') == true
    
    'cp_1557287118_X6nbxJ8DHk'
    // config('recommendation.code_structure.prefix') == 'cp'
    // config('recommendation.code_structure.timestamp') == true
    // config('recommendation.code_structure.symbol') == '_'
```
