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
        'ClassId', 'AccountId', 'CourseId', 'Active'
    ];

    public function getStudentInfo() {
        // Input :
        // Output :
        // Description : get information of whole students related to specific class

        return $this->hasMany('App\ClassMember', 'ClassId', 'ClassId'); // return all members of class
    }

    public function getTotalInvitedStudent() {
        // Input :
        // Output :
        // Description : get the number of whole students that teacher invited

        return $this->hasMany('App\Invitation', 'ClassId', 'ClassId');
    }

    public function getMatchedStudent() {
        // Input :
        // Output :
        // Description : get the number of matched students who accepted teacher's invitation

        return $this->hasMany('App\Invitation', 'ClassId', 'ClassId');
    }
    public function getCourseInfo() {
        // Input :
        // Output :
        // Description : get the information of course that related to class

        return $this->hasOne('App\Course', 'CourseId', 'CourseId');
    }

    public function getUserInfo() {
        // Input :
        // Output :
        // Description :

        return $this->hasManyThrough('App\Account', 'App\Invitation', 'ClassId', 'id', 'ClassId', 'InviteeId');
    }
}
