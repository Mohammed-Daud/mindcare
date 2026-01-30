<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfessionalDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'medical_license_id',
        'years_of_experience',
        'professional_biography',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specializations()
    {
        return $this->hasMany(DoctorSpecialization::class);
    }

    public function education()
    {
        return $this->hasMany(DoctorEducation::class);
    }
}
