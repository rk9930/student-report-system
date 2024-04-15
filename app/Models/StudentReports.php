<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReports extends Model
{
    use HasFactory;

    protected $table = 'student_reports';
    protected $fillable = ['student_id','first_name','last_name','class','email','scores','total_marks','remarks','percentage','grade'];

}
