<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'name', 'description', 'price', 'category_id'
    ];

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }
    
}
