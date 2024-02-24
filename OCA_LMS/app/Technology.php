<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function topics()
    {
        return $this->hasMany(Topic::class, 'technologycohort_id');
    }
}
