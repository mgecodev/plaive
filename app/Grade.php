<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Grades';


    protected $fillable = [
        'GradeId', 'ClassMemberId', 'CourseworkId', 'Grade'
    ];

    
}
