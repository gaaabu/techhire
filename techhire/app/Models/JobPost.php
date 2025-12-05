<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'requirements', 'location', 'job_type',
        'salary_range', 'tech_stack', 'experience_level', 'employer_id', 'status'
    ];

    protected $casts = [
        'tech_stack' => 'array'
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}