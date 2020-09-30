<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    //table name
    protected $table = 'categories';

    // primary key
    protected $primaryKey = "id";

    // mass assignable
    protected $fillable = ['id', 'category_name', 'image', 'description'];

    /**
     * Get the devices for the category
     */
    public function devices()
    {
        return $this->hasMany('App\Device');
    }
}
