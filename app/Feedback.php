<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'feedback';
    
    protected $guarded = ['id', 'user_id'];
    
    protected $dates = ['created_at'];
    
    public $timestamps = false;
    
    public function user()
    {
        $this->belongsTo('App\User', 'user_id', 'id');
    }
}
