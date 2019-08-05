<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Invitations';


    protected $fillable = [
        'InvitationId', 'InviterId', 'InviteeId', 'ClassId', 'Accepted'
    ];
}
