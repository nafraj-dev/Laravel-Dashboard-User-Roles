<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = ['account_name', 'email', 'password'];

    // You might want to hide the password field when retrieving the model
    protected $hidden = ['password'];
}
