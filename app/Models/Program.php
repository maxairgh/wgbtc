<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

               /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'code',
        'title',  
        'status', 
        'created_at', 
        'updated_at', 
    ];

        /**
     * Get the courses associated with the program.
     */
    public function courses()
    {
        return $this->hasMany(Course::class,'program_id','id');
    }

}
