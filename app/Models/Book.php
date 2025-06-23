<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsToMany(User::class);
    }
    protected $fillable = ['title', 'description', 'admin_id', 'supplier_id', 'category_id'];
}
