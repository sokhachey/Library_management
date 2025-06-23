<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function cotegory()
    {
        return $this->hasOne(Category::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    protected $fillable = ['title', 'description', 'admin_id', 'supplier_id', 'category_id'];
}
