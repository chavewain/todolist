<?php

namespace App;

use App\Category;
use App\Transformers\TaskTransformer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    public $transformer = TaskTransformer::class;

	const TASK_UNAVAILABLE = 'unavailable';
	const TASK_AVAILABLE = 'available';

    protected $dates = ['deleted_at'];

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
