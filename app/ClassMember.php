<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassMember extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ClassMembers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ClassMemberId', 'ClassId', 'AccountId', 'Active'
    ];

}
