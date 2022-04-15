<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursecontent extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'chapter',
        'title', 
        'video', 
        'status', 
        'details', 
        'order', 
        'created_at',
        'updated_at', 
    ];

            /**
     * Get the published content associated with the content item.
     */
    public function published(){
        return $this->hasMany(PubblishContent::class,'content_id','id');
    }

    public function publishedForActiveTerm($id){
        return $this->published()->where('term_id', $id)->first();
    }

}
