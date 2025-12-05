<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->string('location');
            $table->enum('job_type', ['full_time', 'part_time', 'contract', 'remote']);
            $table->string('salary_range')->nullable();
            $table->json('tech_stack');
            $table->enum('experience_level', ['entry', 'mid', 'senior']);
            $table->foreignId('employer_id')->constrained('users');
            $table->enum('status', ['active', 'inactive', 'closed'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}