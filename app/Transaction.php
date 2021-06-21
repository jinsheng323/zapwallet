<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public function User()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
}
