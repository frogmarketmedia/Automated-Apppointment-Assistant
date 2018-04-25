<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = ['user_id','client_id','rating'];
}
