<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAcademy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'academy_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
}
