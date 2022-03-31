<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OnlineRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'firstname', 
        'lastname', 
        'middlename', 
        'gender', 
        'dob', 
        'status',  
        'marital_status', 
        'mobile', 
        'email', 
        'denomination', 
        'position', 
        'picture', 
        'program_id',
        'created_at', 
        'updated_at',
    ];
    
    public function getAge() {
        return Carbon::parse($this->dob)->age; 
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id','id');
    }
}
