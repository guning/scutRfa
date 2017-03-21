<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table ='report';
    
    protected $dateFormat = 'U';
    
    protected $fillable = ['title', 'abstract'];
}
