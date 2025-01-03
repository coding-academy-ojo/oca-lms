<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology_Cohort extends Model
{
    protected $fillable = [
        'technology_id',
        'cohort_id',
        'start_date',
        'end_date',
        'satisfaction_rate',
    ];

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }
    
    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }
}
