<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
{
    Auth::logout();
    return redirect('login');
}
    // Добавете този метод
    protected function authenticated($request, $user)
    {
        if ($user->perms >= 1) {
            return redirect()->route('admindashboard');
        }

        return redirect($this->redirectTo);
    }
}
