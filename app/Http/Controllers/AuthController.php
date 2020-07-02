<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\UserNotExistException;
use App\Http\Factory\UserFactory;
use App\Http\Services\UserServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserServices();
    }

    public function index(Request $request)
    {
        return view('auth.index');
    }

    public function authenticate(Request $request)
    {
        try {
            $userRequest = UserFactory::create($request->post());
            $user = $this->userService->authenticate($userRequest);
            UserFactory::verify($user);
            $this->userService->createSession($request, $user);

            return redirect('/admin');
        } catch (UserNotExistException $erro) {
            return view('auth.index', ['error' => $erro->getMessage()]);
        } catch (\UnexpectedValueException $erro) {
            return view('auth.index', ['error' => $erro->getMessage()]);
        } catch (\Exception $erro) {
            return view('auth.index', ['error' => 'Estamos com problemas. Por favor, tente mais tarde.']);
        }
    }
}
