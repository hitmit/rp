<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;


    public function porns()
    {
		return $this->belongsToMany('App\Entities\PornModel', 'porn_categories', 'category_id', 'porn_id');
    }
}
