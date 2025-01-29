<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    //if table doesn't match the model name 
    protected $table = 'job_listings';

    protected $fillable = ['title', 'description'];
}
