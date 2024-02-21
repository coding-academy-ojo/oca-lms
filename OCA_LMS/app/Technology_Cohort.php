<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology_Cohort extends Model
{
    protected $fillable = ['name'];
    
    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }
}
