<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSpecialization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'professional_detail_id',
        'specialization',
    ];

    public function professionalDetail()
    {
        return $this->belongsTo(ProfessionalDetail::class);
    }
}
