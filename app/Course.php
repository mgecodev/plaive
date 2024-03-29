<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Courses';


    protected $fillable = [

        'CourseId', 'Title', 'NumOfStudent', 'HourCount', 'WeekCount', 'Prerequisite', 'Comment', 'Active', 'CreatedBy','CourseImage'
    ];

    public function getTeacherInfo() {

        return $this->hasOne('App\Account', 'id', 'CreatedBy');
    }

    public function getCoursework() {

        return $this->hasMany('App\Coursework', 'CourseId', 'CourseId');
    }

    public function getSubCourseworks() {

        return $this->hasManyThrough('App\SubCoursework', 'App\Coursework','CourseId','CourseworkId','CourseId','CourseworkId');
    }
}
