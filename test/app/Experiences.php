<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiences extends Model
{
    protected $fillable = ['user_id','work_place','designation','present'];
}
