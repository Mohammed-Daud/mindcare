<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'user_type',
        'created_at',
    ];

    public $timestamps = false;

    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';
}