<?php

namespace App;
use App\Technology_Cohort;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    // use HasFactory;

    protected $fillable = [
        'technology_category_id',
        'technologies_name',
        'technologies_description',
        'technologies_resources',
        'technologies_trainingPeriod',
        'technologies_photo',
    ];

    public function category()
    {
        return $this->belongsTo(TechnologyCategory::class, 'technology_category_id');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'cohort_technology')->withPivot('start_date', 'end_date');
    }

    public function technologyCohorts()
    {
        return $this->hasMany(Technology_Cohort::class);
    }
}
