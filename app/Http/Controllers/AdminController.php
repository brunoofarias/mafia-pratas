<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\UserNotAuthenticatedException;
use App\Http\Services\UserServices;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $userServices;

    public function __construct()
    {
        $this->userServices = new UserServices();
    }

    public function index(Request $request) {
        try {
            $this->userServices->verifySession($request);

            return view('admin.index');
        } catch (UserNotAuthenticatedException $e) {
            return view('auth.index', ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            return view('auth.index', ['error' => 'Estamos com problemas. Por favor, tente mais tarde.'.$e->getMessage()]);
        }
    }
}
