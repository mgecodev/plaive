<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    public $primaryKey = 'StudentRecordId';
    protected $table = 'StudentRecords';
    protected $guarded = [];
}
