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
    protected $table = 'Coursework';

    protected $fillable = [
        'CourseworkId', 'CourseId', 'WeekNumber', 'Content'
    ];
}
