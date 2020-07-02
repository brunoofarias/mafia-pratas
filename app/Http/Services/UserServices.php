<?php


namespace App\Http\Services;


use App\Http\Exceptions\UserNotAuthenticatedException;
use App\User;
use Illuminate\Http\Request;

class UserServices
{
    public function authenticate(User $user)
    {
        $user = User::where([
            'email' => $user->email,
            'password' => $user->password
        ])->first();

        return $user;
    }

    public function createSession(Request $request, User $user) {
        $request->session()->put('id', $user->id);
        $request->session()->put('name', $user->firstname.' '.$user->lastname);
        $request->session()->put('email', $user->email);
        $request->session()->put('cpf', $user->cpf);
    }

    public function verifySession(Request $request) {
        if (!$request->session()->get('id') || !$request->session()->get('email') || !$request->session()->get('cpf')) {
            throw new UserNotAuthenticatedException('Sessão expirada.');
        }
    }
}
