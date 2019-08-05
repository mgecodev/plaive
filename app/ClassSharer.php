<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSharer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ClassSharers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ClassSharerId', 'ClassId', 'AccountId', 'Active'
    ];

}
