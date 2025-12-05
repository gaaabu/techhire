<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id', 'job_seeker_id', 'cover_letter', 'status'
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}