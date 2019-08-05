<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'AccountTypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'AccountTypeId', 'Type'
    ];

}
