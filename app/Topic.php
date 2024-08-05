<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    use SoftDeletes;


    public function assignments()
    {
        return $this->hasMany('App\Assignment', 'topic_id');
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }

    // public function technologyCohort()
    // {
    //     return $this->belongsTo(Technology_Cohort::class);
    // }
    public function technologyCohort()
    {
        return $this->belongsTo(Technology_Cohort::class, 'technology_cohort_id');
    }

    // public function projects()
    // {
    //     return $this->hasManyThrough('App\Project', 'App\Classroom', 'topic_id', 'classroom_id');
    // }

    // Add any additional relations you need
}
