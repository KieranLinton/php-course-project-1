<?php

namespace core;

use PDO;
use modules\users\models\User;

class Auth
{
    protected $dbc;

    public function __construct(PDO $dbc)
    {
        $this->dbc = $dbc;
    }

    function checkLogin(string $username, string $password)
    {
        $userObj = new User($this->dbc);

        if (!$userObj->findBy('username', $username)) {
            return false;
        }

        if ($userObj->{'password'} !== md5($password . ENCRYPTION_SALT . $userObj->{'password_hash'})) {
            return false;
        }

        return true;
    }


    function setUserPassword(string $username, string $password)
    {

        $userObj = new User($this->dbc);

        if (!$userObj->findBy('username', $username)) {
            return false;
        }

        $tmp = date("YmdHis") . random_bytes(10) . "232323";
        $newPasswordHash = md5($tmp);
        $newPassword = md5($password . ENCRYPTION_SALT . $newPasswordHash);

        $userObj->{"password"} = $newPassword;
        $userObj->{"password_hash"} = $newPasswordHash;

        return $userObj;
    }
}
