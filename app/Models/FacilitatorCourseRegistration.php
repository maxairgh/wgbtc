<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitatorCourseRegistration extends Model
{
    use HasFactory;

    use HasFactory;
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'learner_id', 
        'course_id', 
        'checks', 
        'created_at', 
        'updated_at',
    ];

}
