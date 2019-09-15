<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
	use HasMediaTrait;
	use SoftDeletes;
	
	protected $fillable = [
		'name', 'description', 'price', 'category_id'
	];

	public function Category()
	{
		return $this->belongsTo('App\Category');
	}
	
}
