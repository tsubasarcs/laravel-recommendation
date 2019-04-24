<?php

namespace Tsubasarcs\Recommendations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model
{
    use SoftDeletes;

    protected $table = 'recommendations';

    protected $fillable = [
        'type',
        'code',
        'status',
    ];
}
