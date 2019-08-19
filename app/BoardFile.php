<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardFile extends Model
{
    //
    public $primaryKey = 'FileId';
    protected $table = 'BoardFiles';
    protected $guarded = [];
}
