<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->hasMany(User::class);
    }

     public function book(){
        return $this->hasMany(Book::class);
    }

     public function report(){
        return $this->hasMany(Report::class);
    }
    protected $fillable = ['name', 'email', 'password'];
}
