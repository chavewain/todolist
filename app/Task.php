<?php

namespace App;

use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

	const TASK_UNAVAILABLE = 'unavailable';
	const TASK_AVAILABLE = 'available';

    protected $fillable = [
    	'name',
    	'description',
    	'status',
    	'image',
    	'user_id',
    ];

    public function isAvailable()
    {
    	return $this->status == Task::TASK_AVAILABLE;
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

}
