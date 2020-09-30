<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'borrows';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'project_name',
        'request_date',
        'status', //(0: waiting(default), 1: accepted, 2: canceled, 3: transfered, 4: reterned, 5: expired)
        'note',
        'start_date',
        'end_date',
        'user_id', 'device_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function device()
    {
        return $this->belongsTo('App\Device');
    }
}
