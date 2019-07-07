<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PornThumbModel extends Model
{
    protected $table = 'porn_thumbs';

    protected $fillable = [
        'porn_id',
        'thumb',
    ];

    public $timestamps = false;
}
