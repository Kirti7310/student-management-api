<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'course',
        'age'

    ];


    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

  
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
