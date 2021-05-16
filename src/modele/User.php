<?php


namespace blogapp\modele;


class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
      'name',
      'password',
      'token',
      'expiry_date'
    ];

    public static function getByUsername($username) {
        return User::where('name', '=', $username)->first();
    }

    public static function getById($id) {
        return User::where('id', '=', $id)->first();
    }

    public static function getByToken($token) {
        return User::where('token', '=', $token)->first();
    }

    public static function create($username, $password) {
        $user = new User();
        $user->name = $username;
        $user->password = $password;
        $user->save();
    }

    public static function createToken($id, $token, $expiry_date) {
        if (($user = User::getById($id)) != null)
        {
            $user->token = $token;
            $user->expiry_date = $expiry_date;
            $user->save();
        }
    }

    public static function getToken($id) {
        return (User::getById($id)->token);
    }

    public static function getRight($token) {
        if (!is_null($user = self::getByToken($token)))
            return $user->user_right;
        else
            return -1;
    }

}