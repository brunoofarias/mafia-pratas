<?php


namespace App\Http\Factory;


use App\Http\Exceptions\UserNotExistException;
use App\User;

class UserFactory
{
    public static function create($request)
    {
        try {
            $user = new User();
            $user->email = $request['email'];
            $user->password = $request['password'];

            return $user;
        } catch (\Exception $e) {
            throw new \UnexpectedValueException('Parametros Inválidos');
        }
    }

    public static function verify($user) {
        if (empty($user)) {
            throw new UserNotExistException('Usuário ou senha incorretos');
        }
    }
}
