<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academicyear extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at', 
        'updated_at', 
    ];

          /**
     * Get the programs associated with the user.
     */
    public function terms()
    {
        return $this->hasMany(Term::class,'academyyear_id','id');
    }
}
