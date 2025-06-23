<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
    protected $fillable = ['joined_date', 'exits_date', 'admin_id', 'user_id'];
}
