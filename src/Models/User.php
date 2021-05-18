<?php


namespace blogapp\Models;


class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'surname',
        'nickname',
        'email',
        'password',
        'date_deletion',
        'image',
        'signature',
        'token',
        'token_expiry_date'
    ];

    public static function getByUsername($nickname) {
        return User::where('nickname', '=', $nickname)->first();
    }

    public static function getById($id) {
        return User::where('id', '=', $id)->first();
    }

    public static function create($usr_info) {
        $user = new User();
        $user->name = $usr_info['name'];
        $user->surname = $usr_info['surname'];
        $user->nickname = $usr_info['nick'];
        $user->email = $usr_info['email'];
        $user->password = $usr_info['password'];
        if ($usr_info['image'] != null)
            $user->image = $usr_info['image'];
        $user->save();
    }

    public static function createToken($id, $token, $expiry_date) {
        if (($user = User::getById($id)) != null)
        {
            $user->token = $token;
            $user->token_expiry_date = $expiry_date;
            $user->save();
        }
    }

    public static function getToken($id) {
        return (User::getById($id)->token);
    }

    public static function getRight($name) {
        if (!is_null($user = self::getByUsername($name)))
            return $user->grade;
        else
            return -1;
    }

}