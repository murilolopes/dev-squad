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

	private $rules = array(
        'name' => 'required|unique:products|max:64',
        'description' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required'
    );

    private $errors;

	public function Category()
	{
		return $this->belongsTo('App\Category');
	}

    public function validate($data)
    {
        $valid = \Validator::make($data, $this->rules);

        if ($valid->fails()){
            $this->errors = $valid->errors()->toArray();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
