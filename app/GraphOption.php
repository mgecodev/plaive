<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraphOption extends Model
{
    public $primaryKey = 'OptionId';
    protected $table = 'GraphOptions';
    protected $guarded = [];
}
