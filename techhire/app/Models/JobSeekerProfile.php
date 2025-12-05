<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'resume_path', 'github_url', 'linkedin_url', 
        'portfolio_url', 'skills', 'experience_years'
    ];

    protected $casts = [
        'skills' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}