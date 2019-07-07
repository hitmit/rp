<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PornTagModel extends Model
{
    protected $table = 'porn_tags';

    protected $fillable = [
        'porn_id',
        'tag_id',
    ];

    public $timestamps = false;
}
