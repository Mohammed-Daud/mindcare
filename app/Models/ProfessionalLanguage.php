<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalLanguage extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'professional_id',
        'language',
        'proficiency',
    ];
    
    /**
     * Get the professional that owns the language.
     */
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
    
    /**
     * Get the proficiency levels as an array.
     */
    public static function getProficiencyLevels()
    {
        return [
            'basic' => 'Basic',
            'intermediate' => 'Intermediate',
            'fluent' => 'Fluent',
            'native' => 'Native'
        ];
    }
}
