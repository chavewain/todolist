<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'name',
    	'description',
    ];

    public function tasks()
    {
    	return $this->belongsToMany(Task::class());
    }
}
