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
    public $primaryKey = 'CourseworkId';
    protected $fillable = [
        'CourseworkId', 'CourseId', 'WeekNumber', 'Content', 'ContentNumber'
    ];
    public function getSubCourseworks() {
        return $this->hasMany('App\SubCoursework','CourseworkId');
    }
}
