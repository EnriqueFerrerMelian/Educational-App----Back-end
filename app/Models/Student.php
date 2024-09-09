<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table = "students";
    protected $fillable = [
        'name', 'last_name', 'photo', 'id'
    ];

    public function courses(){
        return $this->belongsToMany(Course::class, 'course_student');
    }
}
