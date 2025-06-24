<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['joined_date', 'exits_date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // ✅ Correct relationship
    }
}
