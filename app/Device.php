<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    //table name
    protected $table = 'devices';

    // primary key
    protected $primaryKey = "id";

    // mass assignable
    protected $fillable = [
        'id',
        'device_name',
        'label_name',
        'description',
        'firmware_version',
        'sn_imei',
        'device_status',
        'available',
        'image',
        'note',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function borrows()
    {
        return $this->hasMany('App\Borrow');
    }
}
