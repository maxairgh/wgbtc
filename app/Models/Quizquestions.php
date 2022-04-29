<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizquestions extends Model
{
    use HasFactory;

                   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'assess_id',
        'question',  
        'type', 
        'answer1', 
        'answer2', 
        'answer3', 
        'answer4', 
        'answers', 
        'created_at', 
        'updated_at', 
    ];

}
