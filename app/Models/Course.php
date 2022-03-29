<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
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
        'credit_value', 
        'status',
        'program_id',
        'created_at', 
        'updated_at', 
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id','id');
    }

}
