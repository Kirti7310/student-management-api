<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'email',
        'phone',
        'course',
        'age'
    ];


    
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }


  
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
