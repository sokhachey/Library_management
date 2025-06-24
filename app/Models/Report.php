<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['joined_date', 'exits_date', 'user_id'];

    public function getCreatedAtAttribute($value) {
        return date('d/m/y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/y', strtotime($value));
    }

    // Format joined_date
    public function getJoinedDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    // Format exits_date, allow null
    public function getExitsDateAttribute($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
