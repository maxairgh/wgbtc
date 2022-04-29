<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'course_id',
        'term_id',
        'assesstype_id',
        'content',
        'attachment',
        'duedate',
        'quiz',
        'time',
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

                  /**
     * Get the programs associated with the user.
     */
    public function term()
    {
        return $this->belongsTo(Term::class,'term_id','id');
    }

                  /**
     * Get the programs associated with the user.
     */
    public function type()
    {
        return $this->belongsTo(Assesstype::class,'assesstype_id','id');
    }

    
                 /**
     * Get the programs associated with the user.
     */
    public function quizes()
    {
        return $this->hasMany(Quizquestions::class,'assess_id','id');
    }

}
