<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function loans()
{
    return $this->hasMany(Loan::class);
}

protected $fillable = [
    'title',
    'author',
    'isbn',
    'publication_year',
    'total_copies',
    'available_copies',
];

protected $casts = [
    'publication_year' => 'integer',
];
}
