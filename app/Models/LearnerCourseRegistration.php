<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerCourseRegistration extends Model
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
        'term_id', 
        'course_id', 
        'checks', 
        'created_at', 
        'updated_at',
    ];

           /**
     * Get the programs associated with the user.
     */
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

}
