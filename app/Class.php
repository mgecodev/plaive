<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Classes';

    protected $fillable = [
        'ClassId', 'AccountId', 'CourseId'
    ];
}
