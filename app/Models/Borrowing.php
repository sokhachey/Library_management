<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    public function getCreatedAtAttribute($value)
    {
        return $value ? date('d/m/y', strtotime($value)) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? date('d/m/y', strtotime($value)) : null;
    }

    public function getBorrowDateAttribute($value)
    {
        return $value ? date('d/m/y', strtotime($value)) : null;
    }

    public function getReturnDateAttribute($value)
    {
        return $value ? date('d/m/y', strtotime($value)) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}