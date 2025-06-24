<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    public function book()
    {
        return $this->hasMany(Book::class);
    }
    protected $fillable = ['name', 'address', 'email'];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/y', strtotime($value));
    }
}
