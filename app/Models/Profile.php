<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['gender', 'address', 'date_of_birth', 'city', 'blood_group'];


    public function student()
    {
        return $this->hasOne(Student::class);
    }



}
