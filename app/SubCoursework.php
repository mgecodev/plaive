<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCoursework extends Model
{
    public $primaryKey = 'SubCourseworkId';
    protected $table = 'SubCourseworks';
    protected $guarded = [];
}
