<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnologyCategory extends Model
{
    protected $fillable = ['Categories_name'];
    
    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }
}
