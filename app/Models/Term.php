<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'academyyear_id',
        'name',
        'start_date',
        'end_date',
        'status',
        'created_at', 
        'updated_at', 
    ];

             /**
     * Get the academic year associated with the user.
     */
    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class,'academyyear_id','id');
    }
}
