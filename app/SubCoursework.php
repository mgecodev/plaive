<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCoursework extends Model
{
<<<<<<< HEAD

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'SubCourseworks';

    protected $fillable = [
        'SubCourseworkId', 'CourseworkId', 'Content'
    ];
=======
    public $primaryKey = 'SubCourseworkId';
    protected $table = 'SubCourseworks';
    protected $guarded = [];
>>>>>>> 544e4c0c63e35ec32908581dc8841546a6415a17
}
