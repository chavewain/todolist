<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name',
    	'description',
    ];

    public function tasks()
    {
    	return $this->belongsToMany(Task::class());
    }
}
