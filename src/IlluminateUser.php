<?php

namespace Tsubasarcs\Recommendations;

use Illuminate\Database\Eloquent\Model;
use Tsubasarcs\Recommendations\Recommendation;

class IlluminateUser extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
