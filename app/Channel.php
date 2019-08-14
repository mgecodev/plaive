<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //
    public $primaryKey = 'ChannelId';
    protected $table = 'Channels';
    protected $guarded = [];
    public function options() {
        return $this->hasMany('App\GraphOption','ChannelId')->orderBy('FieldNumber','asc');
    }
}
