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
    public function getCreatedAtAttribute($value) {
        return date('d/m/y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/y', strtotime($value));
    }

    public function getBorrowDate($value){
        return date('d/m/y', strtotime($value));
    }

    public function getReturnDate($value){
        return date('d/m/y', strtotime($value));
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
