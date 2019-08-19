<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoClass extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'InfoClasses';

    protected $fillable = [
        'ClassId', 'AccountId', 'CourseId'
    ];

    public function getStudentInfo() {
        // Input :
        // Output :
        // Description : get information of whole students related to specific class


    }

    public function getTotalInvitedStudent() {
        // Input :
        // Output :
        // Description : get the number of whole students that teacher invited

    }

    public function getMatchedStudent() {
        // Input :
        // Output :
        // Description : get the number of matched students who accepted teacher's invitation


    }
    public function getCourseInfo() {
        // Input :
        // Output :
        // Description : get the information of course that related to class


    }
}
