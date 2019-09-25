<?php

namespace App;

use App\Task;
use App\Transformers\UserTransformer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const USER_VERIFIED = '1';
    const USER_UNVERIFIED = '0';
    const USER_ADMIN = 'true';
    const USER_REGULAR  = 'false';

    public $transformer = UserTransformer::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    // Mutadores y Accesores

    public function setNameAttribute($valor){  // mutador

        $this->attributes['name'] = strtolower($valor);
    }

    public function getNameAttribute($valor){ // accesor

       $valor = strtolower($valor);

        return ucwords($valor);
    }

    public function setEmailttribute($valor){ // mutador

        $this->attributes['email'] = strtolower($valor);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        'password',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function isVerified()
    {
        return $this->verified == User::USER_VERIFIED;
    }

    public function isAdmin()
    {
        return $this->admin == User::USER_ADMIN;
    }

    public static function generateVerificationToken()
    {
        return str_random(40);
    }
}
