<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCoursework extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'SubCourseworks';

    protected $fillable = [
        'SubCourseworkId', 'CourseworkId', 'Content'
    ];
}
