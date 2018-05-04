<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    protected $fillable = ['user_id','institution','department','degree','present'];
}
