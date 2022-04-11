<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursecontent extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'chapter',
        'title', 
        'video', 
        'status', 
        'details', 
        'order', 
        'created_at',
        'updated_at', 
    ];

}
