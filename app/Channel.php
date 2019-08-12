<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //
    public $primaryKey = 'ChannelId';
    protected $table = 'Channels';
    protected $guarded = [];

}
