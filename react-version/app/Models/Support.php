<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory; // the finality of this is to use in tests with factory

    // $fillable defines what fields can be filled in the database, it's a security measure
    protected $fillable = [
        'subject',
        'body',
        'status'
    ];
}
