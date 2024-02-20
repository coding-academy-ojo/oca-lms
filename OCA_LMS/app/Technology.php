<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function topic()
{
    return $this->hasMany(Topic::class);
}
}
