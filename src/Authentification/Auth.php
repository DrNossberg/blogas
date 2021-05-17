<?php


namespace blogapp\Authentification;

use blogapp\Models\User;


class Auth
{
    public static function authentify($user) {
        // Create cookies
        $expiration = time() + 3600 * 24 * 7;
        setcookie("user_login", $user->name, $expiration);

        $token = random_bytes(16);
        setcookie("token", $token, $expiration);

        // Prepare data for the database
        $token_hash = password_hash($token, PASSWORD_DEFAULT);
        $expiry_date = date("Y-m-d H:i:s", $expiration);

        // Insert token infos in the database
        User::createToken($user->id, $token_hash, $expiry_date);
    }

    public static function isAuthentified() {
        if (isset($_COOKIE['token']) && ($user = User::getByUsername($_COOKIE['user_login']) != null))
            if (password_verify($_COOKIE['token'], $user->token))
                return true;

        return false;
    }

    public static function hasRight($r) {
        return (self::isAuthentified() && (User::getRight($_SESSION['session']['token']) == $r));
    }
}