<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * @return Functions
     */
    public function savePassword($request){
        $this->update([
            'password' => bcrypt($request['password'])
        ]);
    }
    /**
     * @return For Crud User
     */
    public static function createUser($request){
        $user = self::create($request);
        $user->savePassword($request);
        return $user;
    }
    
    /**
     * @return Relathionship
     */
}
