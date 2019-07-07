<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;

    public function porns()
    {
    	return $this->belongsToMany('App\Entities\PornModel', 'porn_tags', 'tag_id', 'porn_id');
    }
}
