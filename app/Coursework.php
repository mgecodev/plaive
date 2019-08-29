<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursework extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Courseworks';

    protected $fillable = [
        'CourseworkId', 'CourseId', 'WeekNumber', 'Content', 'ContentNumber'
    ];

    public function getSubCoursework() {

        return $this->hasMany('App\SubCoursework', 'CourseworkId', 'CourseworkId');
    }
}
