<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PornModel extends Model
{
    protected $table = 'porn';

    protected $fillable = [
        'id',
        'title',
        'date_added',
        'url',
        'duration',
        'username',
        'embed',
    ];

    public $timestamps = false;

    public function tag()
    {
        return $this->belongsToMany(TagModel::class, 'porn_tags');
    }

    public function thumbs()
    {
        return $this->hasMany(PornThumbModel::class, 'porn_id', 'id');
    }  
}
