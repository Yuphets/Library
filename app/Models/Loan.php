<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    protected $casts = [
    'borrowed_at' => 'date',
    'due_at' => 'date',
    'returned_at' => 'date',
];

public function book()
{
    return $this->belongsTo(Book::class);
}

public function member()
{
    return $this->belongsTo(Member::class);
}

protected $fillable = [
    'book_id',
    'member_id',
    'borrowed_at',
    'due_at',
    'returned_at',
    'status',
];
}
