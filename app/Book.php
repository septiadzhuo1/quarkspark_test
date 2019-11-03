<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    function User() {
    	return $this->belongsTo(User::class, 'created_by')
      ->select(['id', 'name', 'email', 'role'])->withDefault();
    }
}
