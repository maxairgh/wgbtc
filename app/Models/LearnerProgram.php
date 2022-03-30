<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerProgram extends Model
{
    use HasFactory;
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'learner_id',
        'program_id', 
        'checks', 
        'startdate', 
        'enddate', 
    ];

        /**
     * Get the learner associated with the user.
     */
    public function learner()
    {
        return $this->belongsTo(Learner::class,'learner_id','id');
    }

            /**
     * Get the learner associated with the user.
     */
    public function program()
    {
        return $this->belongsTo(Program::class,'program_id','id');
    }
    
}
