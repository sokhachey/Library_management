<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class);
    }
    protected $fillable = ['joined_date', 'exits_date', 'user_id'];
}
