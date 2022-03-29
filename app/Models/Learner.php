<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'matrix',
        'firstname', 
        'lastname', 
        'middlename', 
        'gender', 
        'dob',  
        'marital_status', 
        'mobile', 
        'email', 
        'denomination', 
        'position', 
        'user_id', 
        'picture', 
        'status', 
        'created_at', 
        'updated_at',
    ];

       /**
     * Get the programs associated with the user.
     */
    public function programs()
    {
        return $this->hasMany(LearnerProgram::class,'id','program_id');
    }

           /**
     * Get the programs associated with the user.
     */
    public function course()
    {
        return $this->hasMany(Course::class);
    }

}
