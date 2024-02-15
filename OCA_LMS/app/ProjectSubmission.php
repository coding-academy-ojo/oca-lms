<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $fillable = [
        'project_id', 'trainee_id', 'link', 'text_submission'
    ];

    public function trainee()
    {
        return $this->belongsTo(User::class, 'trainee_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
