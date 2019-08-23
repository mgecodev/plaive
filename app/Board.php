<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    //
    public $primaryKey = 'BoardId';
    protected $table = 'Boards';
    protected $guarded = [];
    public function files() {
        return $this->hasMany('App\BoardFile','BoardId')->where('Active',1)->orderBy('created_at','asc');
    }
}
