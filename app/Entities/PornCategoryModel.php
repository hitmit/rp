<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PornCategoryModel extends Model
{
    protected $table = 'porn_categories';

    protected $fillable = [
        'porn_id',
        'category_id',
    ];

    public $timestamps = false;
}
