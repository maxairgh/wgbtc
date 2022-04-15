<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubblishContent extends Model
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
        'content_id', 
        'check', 
        'created_at', 
        'updated_at', 
    ];

            /**
     * Get the course associated with the published item.
     */
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

            /**
     * Get the term associated with the published item.
     */
    public function term()
    {
        return $this->belongsTo(Term::class,'term_id','id');
    }

            /**
     * Get the coursecontent associated with the published item.
     */
    public function coursecontent()
    {
        return $this->belongsTo(Coursecontent::class,'content_id','id');
    }

}
