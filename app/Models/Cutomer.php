<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutomer extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}

