<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    
    use Uuid;
    /**
     * Set table name
     */
    protected $table = 'tutorial';

    /**
    * protected visible 
    */
    protected $visible = [   

    ];

    /**
    * protected hidden fillable
    */
    protected $hidden = [
        'id', 'password', 'api_token', 'online_date'
    ];

    /**
    * Set timestamps off
    */
    public $timestamps = false;
}
