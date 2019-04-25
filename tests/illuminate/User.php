<?php

namespace Tsubasarcs\Recommendations\Tests\Illuminate;

use Illuminate\Database\Eloquent\Model;
use Tsubasarcs\Recommendations\Recommendation;

class User extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
