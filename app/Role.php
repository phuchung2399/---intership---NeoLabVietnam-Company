<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
      //table name
      protected $table = 'roles';

      // primary key
      protected $primaryKey = "id";
  
      // mass assignable
      protected $fillable = ['id', 'role_name',];
  
      public function users()
      {
          return $this->hasMany('App\User');
      }
}
