<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * The primary key of User
     *
     * @var string
     */
    public $primaryKey = 'nim';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * The roles that are available for the users.
     *
     * @var array
     */
    public static $roles = ['admin', 'spectator', 'user', 'public'];

    public function profile()
    {
        return $this->hasOne('\App\Profile', 'nim', 'nim');
    }

    /**
     * Check if the current user is allowed to edit profiles
     * for a given nim.
     *
     * @param $nim
     */
    public function isAllowedToEdit($nim)
    {
        // it is allowed if the nim matches current user, or current user is an admin
        return $this->nim == $nim || $this->role == 'admin';
    }

}
