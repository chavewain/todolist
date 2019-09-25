<?php

namespace App;


use App\Transformers\CategoryTransformer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{	

	use SoftDeletes;

    public $transformer = CategoryTransformer::class;

	protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'description'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function tasks(){
    	return $this->belongsToMany(Task::class);
    }
}
